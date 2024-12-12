<?php
include_once "../config/dbconnect.php";

if (isset($_POST['upload'])) {
    $isbn = $_POST['isbn_no'];
    $booksName = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $author = $_POST['author'];

    $coverImage = $_FILES['file']['name'];
    $coverTemp = $_FILES['file']['tmp_name'];

    $bookFile = $_FILES['book_file']['name'];
    $bookTemp = $_FILES['book_file']['tmp_name'];

    $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $coverImageExtension = strtolower(pathinfo($coverImage, PATHINFO_EXTENSION));

    $allowedBookExtensions = ['pdf'];
    $bookFileExtension = strtolower(pathinfo($bookFile, PATHINFO_EXTENSION));

    $coverImageLocation = "./uploads/";
    $bookFileLocation = "./book_files/";

    $targetCoverDir = $_SERVER['DOCUMENT_ROOT'] . '/elibrary/uploads/';
    $targetBookDir = $_SERVER['DOCUMENT_ROOT'] . '/elibrary/uploads/file/';

    if (!is_dir($targetCoverDir)) {
        mkdir($targetCoverDir, 0755, true);
    }

    if (!is_dir($targetBookDir)) {
        mkdir($targetBookDir, 0755, true);
    }

    if (in_array($coverImageExtension, $allowedImageExtensions)) {
        if (move_uploaded_file($coverTemp, $targetCoverDir . $coverImage)) {
            if ($bookFileExtension === 'pdf') {
                if (move_uploaded_file($bookTemp, $targetBookDir . $bookFile)) {
                    $insert_query = "INSERT INTO books 
                    (isbn_no, title, cover_image, author, price, `description`, category_id, book_file, added_on) 
                    VALUES ('$isbn', '$booksName', '$coverImage', '$author', $price, '$desc', '$category', '$bookFile', NOW())";

                    $insert = mysqli_query($conn, $insert_query);

                    if (!$insert) {
                        http_response_code(500);
                        echo json_encode(["status" => "error", "message" => "Internal Server Error"]);
                    } else {
                        http_response_code(200);
                        echo json_encode(["status" => "success", "message" => "Records added successfully."]);
                    }
                } else {
                    http_response_code(500);
                    echo json_encode(["status" => "error", "message" => "Failed to upload book file."]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Only PDF files are allowed for the book file."]);
            }
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Failed to upload cover image."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Only JPG, JPEG, PNG, or GIF files are allowed for the cover image."]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request."
    ]);
}
?>
