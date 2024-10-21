<?php
include_once "../config/dbconnect.php";

$isbn_no = $_POST['isbn_no'];
$name = $_POST['name'];
$desc = $_POST['desc'];
$author = $_POST['author'];
$price = $_POST['price'];
$category = $_POST['category'];
$image = $_POST['existingImage'];

if (isset($_FILES['newImage']) && $_FILES['newImage']['error'] == 0) {
    $dir = $_SERVER['DOCUMENT_ROOT'] . '/elibrary-admin/uploads/';
    
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $img = $_FILES['newImage']['name'];
    $tmp = $_FILES['newImage']['tmp_name'];
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'webp');
    $image = rand(1000, 1000000) . "." . $ext;

    if (in_array($ext, $valid_extensions)) {
        if (!move_uploaded_file($tmp, $dir . $image)) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Failed to upload the image.']);
            exit();
        }
    } else {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Invalid image format.']);
        exit();
    }
}

$sql = "UPDATE books SET title = '$name', 
        description = '$desc', 
        author = '$author',
        price = $price, 
        category_id = '$category', 
        cover_image = '$image' 
        WHERE isbn_no = '$isbn_no'";
$updateItem = mysqli_query($conn, $sql);

if ($updateItem) {
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Item updated successfully.']);
} else {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Failed to update item: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?>
