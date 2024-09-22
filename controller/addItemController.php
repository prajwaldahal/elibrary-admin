<?php
include_once "../config/dbconnect.php";

if (isset($_POST['upload'])) {
    $isbn = $_POST['isbn_no'];
    $booksName = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $author = $_POST['author'];

    $name = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];

    $location = "./uploads/";
    $image = $location . $name;

    $target_dir = "../uploads/";
    $finalImage = $target_dir . $name;

    if (move_uploaded_file($temp, $finalImage)) {
        $insert_query = "INSERT INTO books 
        (isbn_no, title, cover_image, author, price, `description`, category_id, added_on) 
        VALUES ('$isbn', '$booksName', '$image', '$author', $price, '$desc', '$category', NOW())";

        $insert = mysqli_query($conn, $insert_query);

        if (!$insert) {
            unlink($finalImage);
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Internal Server Error"]);
        } else {
            http_response_code(200);
            echo json_encode(["status" => "success", "message" => "Records added successfully."]);
        }
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to upload file."]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request."
    ]);
}
?>
