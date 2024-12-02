<?php
// Insert Rental Transaction
function insertRentalTransaction($data) {
    global $conn;
    $userId = mysqli_real_escape_string($conn, $data['id']);
    $transactionData = json_encode($data['transaction_data']);
    
    $sql = "INSERT INTO rental_transactions (user_id, transaction_data) VALUES ('$userId', '$transactionData')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Rental transaction inserted successfully."]);
    } else {
        echo json_encode(["error" => "Error inserting rental transaction."]);
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
        $conditions[] = "(SELECT AVG(r.rating) FROM reviews r WHERE r.isbn_no = b.isbn_no) >= '$min_rating'";
    }

    $whereClause = '';
    if (!empty($conditions)) {
        $whereClause = 'WHERE ' . implode(' AND ', $conditions);
    }

    $sql = "SELECT b.*, c.category_name, 
                   (SELECT AVG(r.rating) FROM reviews r WHERE r.isbn_no = b.isbn_no) AS avg_rating
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
        echo json_encode(["message" => "No books found matching the search criteria."]);
    }
}



function getHistoryById($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM rented_books_history WHERE user_id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $history = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $history[] = $row;
        }
        echo json_encode($history);
    } else {
        echo json_encode(["message" => "No history found for user ID $id."]);
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

// Insert Review
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

// Get All Reviews
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
    $sql = "SELECT id,category_name from categories";
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
?>
