<?php

include_once "../config/dbconnect.php";

$c_id = $_POST['record'];

$query = "UPDATE categories SET is_deleted = 1 WHERE id = '$c_id'";
$data = mysqli_query($conn, $query);

if ($data) {
    http_response_code(200);
    echo json_encode(["status" => "success", "message" => "Category item marked as deleted."]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Not able to update."]);
}
?>
