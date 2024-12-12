<?php
function insertRentalTransaction($data) {
    global $conn;
    
    $userId = trim(mysqli_real_escape_string($conn, $data['userId']));
    $isbnNo = trim(mysqli_real_escape_string($conn, $data['isbn']));
    $rentalDate = trim(mysqli_real_escape_string($conn, $data['rental_date']));
    $expiryDate = trim(mysqli_real_escape_string($conn, $data['expiry_date']));
    $amountPaid = trim(mysqli_real_escape_string($conn, $data['amount_paid']));

    $checkSql = "SELECT * FROM rental_transactions WHERE user_id = '$userId' AND isbn_no = '$isbnNo' LIMIT 1";
    $checkResult = mysqli_query($conn, $checkSql);

    if (!$checkResult) {
        echo json_encode(["error" => "Error in SELECT query: " . mysqli_error($conn)]);
        return;
    }

    if (mysqli_num_rows($checkResult) > 0) {
        $updateSql = "UPDATE rental_transactions 
                      SET rental_date = '$rentalDate', expiry_date = '$expiryDate', amount_paid = '$amountPaid'
                      WHERE user_id = '$userId' AND isbn_no = '$isbnNo'";
        
        if (mysqli_query($conn, $updateSql)) {
            echo json_encode(["message" => "Rental transaction updated successfully."]);
        } else {
            echo json_encode(["error" => "Error updating rental transaction: " . mysqli_error($conn)]);
        }
    } else {
        $insertSql = "INSERT INTO rental_transactions (user_id, isbn_no, rental_date, expiry_date, amount_paid) 
                      VALUES ('$userId', '$isbnNo', '$rentalDate', '$expiryDate', '$amountPaid')";
        
        if (mysqli_query($conn, $insertSql)) {
            echo json_encode(["message" => "Rental transaction inserted successfully."]);
        } else {
            echo json_encode(["error" => "Error inserting rental transaction: " . mysqli_error($conn)]);
        }
    }
}


function getRentedBooks($userId) {
    global $conn;

    $deleteSql = "
        DELETE FROM rental_transactions
        WHERE user_id = ? AND expiry_date < CURDATE()
    ";

    if ($deleteStmt = $conn->prepare($deleteSql)) {
        $deleteStmt->bind_param("s", $userId);
        if (!$deleteStmt->execute()) {
            echo json_encode(["error" => "Error deleting expired books: " . $deleteStmt->error]);
            return;
        }
        $deleteStmt->close();
    } else {
        echo json_encode(["error" => "Error preparing delete query"]);
        return;
    }

    $sql = "
        SELECT 
            rt.id AS rental_id,
            rt.user_id,
            rt.isbn_no,
            b.title,
            b.author,
            b.cover_image,
            b.description,
            b.price,
            b.book_file,
            rt.rental_date,
            rt.expiry_date,
            rt.amount_paid
        FROM rental_transactions rt
        JOIN books b ON rt.isbn_no = b.isbn_no
        WHERE rt.user_id = ? 
          AND rt.expiry_date >= CURDATE() 
          AND b.is_deleted = 0
          AND rt.id = (
              SELECT MAX(sub_rt.id)
              FROM rental_transactions sub_rt
              WHERE sub_rt.user_id = rt.user_id AND sub_rt.isbn_no = rt.isbn_no
          )
    ";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $rentedBooks = [];
        while ($row = $result->fetch_assoc()) {
            $rentedBooks[] = $row;
        }

        $stmt->close();
        
        if (empty($rentedBooks)) {
            echo json_encode([]);
        } else {
            echo json_encode($rentedBooks);
        }
    } else {
        echo json_encode(["error" => "Error preparing SQL query"]);
    }
}



function getHistoryById($id) {
    global $conn;

    $sql = "
        SELECT 
            rb.id AS history_id,
            rb.user_id,
            rb.isbn_no,
            b.title,
            b.author,
            b.cover_image,
            b.price,
            rb.rented_date,
            rb.expired_date,
            rb.price
        FROM rented_books_history rb
        JOIN books b ON rb.isbn_no = b.isbn_no
        WHERE rb.user_id = ? 
          AND b.is_deleted = 0
    ";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $history = [];
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }

        $stmt->close();

        if (empty($history)) {
            echo json_encode([]);
        } else {
            echo json_encode($history);
        }
    } else {
        echo json_encode(['error'=>'much error']);
    }
}


function searchBooks($filterOptions) {
    global $conn;

    $conditions = [];

    if (!empty($filterOptions['keyword'])) {
        $keyword = mysqli_real_escape_string($conn, $filterOptions['keyword']);
        $conditions[] = "(b.title LIKE '%$keyword%' OR b.author LIKE '%$keyword%' OR b.isbn_no LIKE '%$keyword%')";
    }

    if (!empty($filterOptions['category_id'])) {
        $category_id = mysqli_real_escape_string($conn, $filterOptions['category_id']);
        $conditions[] = "b.category_id = '$category_id'";
    }

    if (!empty($filterOptions['max_price'])) {
        $max_price = mysqli_real_escape_string($conn, $filterOptions['max_price']);
        $conditions[] = "b.price <= '$max_price'";
    }

    if (!empty($filterOptions['min_rating'])) {
        $min_rating = mysqli_real_escape_string($conn, $filterOptions['min_rating']);
        $conditions[] = "(SELECT COALESCE(AVG(r.rating), 0) FROM reviews r WHERE r.isbn_no = b.isbn_no) >= '$min_rating'";
    }

    $whereClause = '';
    if (!empty($conditions)) {
        $whereClause = 'WHERE ' . implode(' AND ', $conditions);
    }

    $sql = "SELECT b.*, c.category_name, 
                   (SELECT COALESCE(AVG(r.rating), 0) FROM reviews r WHERE r.isbn_no = b.isbn_no) AS avg_rating
            FROM books b
            LEFT JOIN categories c ON b.category_id = c.id
            $whereClause
            AND b.is_deleted = 0";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $books = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }
        echo json_encode($books);
    } else {
        echo json_encode([]);
    }
}


function insertRequestedBook($data) {
    global $conn;
    $userId = mysqli_real_escape_string($conn, $data['id']);
    $bookDetails = json_encode($data['book_details']);
    
    $sql = "INSERT INTO requestedbook (user_id, book_details) VALUES ('$userId', '$bookDetails')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Book request inserted successfully."]);
    } else {
        echo json_encode(["error" => "Error inserting book request."]);
    }
}

function registerUser($data) {
    global $conn;

    $userId = mysqli_real_escape_string($conn, $data['id']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $fullName = mysqli_real_escape_string($conn, $data['full_name']);
    $photoUrl = mysqli_real_escape_string($conn, $data['photourl']);
    $registrationDate = date('Y-m-d');

    $sql = "INSERT INTO users (id, email, full_name, photourl, registration_date) 
            VALUES ('$userId', '$email', '$fullName', '$photoUrl', '$registrationDate')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "User registered successfully."]);
    } else {
        echo json_encode(["error" => "Error registering user: " . mysqli_error($conn)]);
    }
}

function insertReview($data) {
    global $conn;
    $userId = mysqli_real_escape_string($conn, $data['id']);
    $isbnNo = mysqli_real_escape_string($conn, $data['isbn_no']);
    $review = mysqli_real_escape_string($conn, $data['review']);
    $rating = mysqli_real_escape_string($conn, $data['rating']);
    
    $sql = "INSERT INTO reviews (user_id, isbn_no, review_text, rating, review_date) 
            VALUES ('$userId', '$isbnNo', '$review', '$rating', NOW())";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Review inserted successfully."]);
    } else {
        echo json_encode(["error" => "Error inserting review."]);
    }
}

function getAllReviews() {
    global $conn;
    $sql = "SELECT r.*, u.full_name AS user_name, b.title AS book_title 
            FROM reviews r
            JOIN users u ON r.user_id = u.id
            JOIN books b ON r.isbn_no = b.isbn_no";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $reviews = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $reviews[] = $row;
        }
        echo json_encode($reviews);
    } else {
        echo json_encode(["message" => "No reviews found."]);
    }
}

function getAllCategories() {
    global $conn;
    $sql = "SELECT id, category_name from categories";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        echo json_encode($categories);
    } else {
        echo json_encode(["message" => "No categories found."]);
    }
}
?>
