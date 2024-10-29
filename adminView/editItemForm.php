<?php
    include_once "../config/dbconnect.php";
    
    if (isset($_POST['record'])) {
        $isbn_no = $_POST['record'];
        $sql = "SELECT * FROM books WHERE isbn_no = '$isbn_no'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $book = mysqli_fetch_assoc($result);
        } else {
            echo "Book not found!";
            exit;
        }
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Internal Server Error"]);
        exit;
    }
?>

<div class="container d-flex justify-content-center align-items-center" >
    <div class="col-md-8">
        <form id="updateBookForm" enctype="multipart/form-data" method="POST" onsubmit="return updateItems()">
            <div class="form-group">
                <input type="hidden" class="form-control" name="isbn_no" id="isbn" value=" <?=$book['isbn_no']?> ">
            </div>

            <div class="form-group">
                <label for="name">Title:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?=$book['title']?>" required>
                <small id="nameHelp" class="text-danger"></small>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control custom-input" name="price" id="price" value="<?=$book['price']?>" step="0.1" min="5" required>
                <small id="priceHelp" class="text-danger"></small>
            </div>

            <div class="form-group">
                <label for="desc">Description:</label>
                <textarea class="form-control custom-input" name="desc" id="desc" rows="4" required><?=$book['description']?></textarea>
                <small id="descHelp" class="text-danger"></small>
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control custom-input" name="author" id="author" value="<?=$book['author']?>" required>
                <small id="authorHelp" class="text-danger"></small>
            </div>

            <div class="form-group">
                <label>Category:</label>
                <select id="category" name="category" class="form-control custom-input" required>
                    <option disabled selected>Select category</option>
                    <?php
                    $sql = "SELECT * FROM categories";
                    $categories = $conn->query($sql);
                    if ($categories->num_rows > 0) {
                        while ($row = $categories->fetch_assoc()) {
                            $selected = ($row['id'] == $book['category_id']) ? 'selected' : '';
                            echo "<option value='" . $row['id'] . "' $selected>" . $row['category_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <small id="categoryHelp" class="text-danger"></small>
            </div>

            <div class="form-group">
                <label for="existingImage">Current Image:</label>
                <img id="existingImage" src="uploads/<?=$book['cover_image']?>" alt="Current Book Image" style="width: 150px; height: auto;">
                <input type="hidden" name="existingImage" value="<?=$book['cover_image']?>">
            </div>

            <div class="form-group">
                <label for="newImage">Choose New Image (if any):</label>
                <input type="file" class="form-control-file custom-input" name="newImage" id="newImage">
                <small id="fileHelp" class="text-danger"></small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-secondary" name="update" style="border-radius: 15px; font-weight: bold; transition: background-color 0.3s ease-in-out, transform 0.2s;">Update Book</button>
            </div>
        </form>
    </div>
</div>
