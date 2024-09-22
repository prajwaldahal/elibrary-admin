<?php

include_once "../config/dbconnect.php";

$id = $_POST['record'];

$query = "UPDATE books SET is_deleted = true WHERE isbn_no = '$id'";
$data = mysqli_query($conn, $query);

if ($data) {
    http_response_code(200);
    echo json_encode(["status" => "success", "message" => "Book is deleted."]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error deleting the book."]);
}
?>
