<?php
include_once "../config/dbconnect.php";

$isbn_no = trim($_POST['isbn_no']);
$name = trim($_POST['name']);
$desc = trim($_POST['desc']);
$author = trim($_POST['author']);
$price = trim($_POST['price']);
$category = trim($_POST['category']);
$image = trim($_POST['existingImage']);

if (isset($_FILES['newImage']) && $_FILES['newImage']['error'] === 0) {
    $dir = $_SERVER['DOCUMENT_ROOT'] . '/elibrary/uploads/';
    
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $img = $_FILES['newImage']['name'];
    $tmp = $_FILES['newImage']['tmp_name'];
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'webp');
    $image = uniqid('', true) . '.' . $ext;

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

$sql = "UPDATE books SET title = ?, `description` = ?, author = ?, price = ?, category_id = ?, cover_image = ? WHERE isbn_no = ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Failed to prepare statement: ' . $conn->error]);
    exit();
}

$stmt->bind_param("sssisss", $name, $desc, $author, $price, $category, $image, $isbn_no);

if ($stmt->execute()) {
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Item updated successfully.', 'image' => $image]);
} else {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Failed to update item: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
