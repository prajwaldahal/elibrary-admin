<?php
include_once "../config/dbconnect.php";

// Retrieve and sanitize input data
$isbn_no = mysqli_real_escape_string($conn, $_POST['isbn_no']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$desc = mysqli_real_escape_string($conn, $_POST['desc']);
$author = mysqli_real_escape_string($conn, $_POST['author']);  
$price = mysqli_real_escape_string($conn, $_POST['price']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$final_image = mysqli_real_escape_string($conn, $_POST['existingImage']);

// Check if a new image is uploaded
if (isset($_FILES['newImage']) && $_FILES['newImage']['error'] == 0) {
    $location = "./uploads/";
    $img = $_FILES['newImage']['name'];
    $tmp = $_FILES['newImage']['tmp_name'];
    $dir = '../uploads/';
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'webp');
    $image = rand(1000, 1000000) . "." . $ext;
    $final_image = $location . $image;  

    // Validate the image extension
    if (in_array($ext, $valid_extensions)) {
        if (!move_uploaded_file($tmp, $dir . $image)) {
            http_response_code(500);
             header('Content-Type: application/json');
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

// Prepare SQL query to update the book details
$sql = "UPDATE books SET 
    title = '$name', 
    description = '$desc', 
    author = '$author',  
    price = $price, 
    category_id = '$category', 
    cover_image = '$final_image' 
    WHERE isbn_no = '$isbn_no'";

// Execute the query
$updateItem = mysqli_query($conn, $sql);

// Check the result of the query
if ($updateItem) {
    http_response_code(200);
     header('Content-Type: application/json');
  echo json_encode(['message' => 'Item updated successfully.']);
} else {
    http_response_code(500);
     header('Content-Type: application/json');
  echo json_encode(['message' => 'Failed to update item: ' . mysqli_error($conn)]);
}
?>
