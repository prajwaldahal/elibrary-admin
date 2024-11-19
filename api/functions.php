<?php
function insertRentalTransaction($data) {
    global $conn;
    $userId = $data['id'];
    $transactionData = json_encode($data['transaction_data']);
    $sql = "INSERT INTO rental_transactions (user_id, transaction_data) VALUES ('$userId', '$transactionData')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Rental transaction inserted successfully."]);
    } else {
        echo json_encode(["error" => "Error inserting rental transaction."]);
    }
}

function getHistoryById($id) {
    global $conn;
    $sql = "SELECT * FROM rental_history WHERE user_id = '$id'";
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
    $userId = $data['id'];
    $bookDetails = json_encode($data['book_details']);
    $sql = "INSERT INTO requested_books (user_id, book_details) VALUES ('$userId', '$bookDetails')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Book request inserted successfully."]);
    } else {
        echo json_encode(["error" => "Error inserting book request."]);
    }
}

function insertReview($data) {
    global $conn;
    $userId = $data['id'];
    $review = $data['review'];
    $sql = "INSERT INTO reviews (user_id, review_text) VALUES ('$userId', '$review')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Review inserted successfully."]);
    } else {
        echo json_encode(["error" => "Error inserting review."]);
    }
}

function getAllReviews() {
    global $conn;
    $sql = "SELECT * FROM reviews";
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
