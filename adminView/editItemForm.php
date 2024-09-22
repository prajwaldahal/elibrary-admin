<div class="container p-5">
    <h4>Edit Book Details</h4>
    <?php
    include_once "../config/dbconnect.php";
    $ID = $_POST['record'];
    $qry = mysqli_query($conn, "SELECT * FROM books WHERE isbn_no='$ID'");
    $numberOfRow = mysqli_num_rows($qry);
    if ($numberOfRow > 0) {
        while ($row1 = mysqli_fetch_array($qry)) {
            $catID = $row1["category_id"];
    ?>
    <form id="update-Items" onsubmit="return updateItems()" enctype='multipart/form-data'>
        <div class="form-group">
            <input type="text" class="form-control" id="book_id" value="<?=$row1['isbn_no']?>" hidden>
        </div>
        <div class="form-group">
            <label for="name">Book Name:</label>
            <input type="text" class="form-control" id="name" value="<?=$row1['title']?>" required>
            <small id="nameHelp" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="desc">Book Description:</label>
            <input type="text" class="form-control" id="desc" value="<?=$row1['description']?>" required>
            <small id="descHelp" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="author">Book Author:</label>
            <input type="text" class="form-control" id="author" value="<?=$row1['author']?>" required>
            <small id="authorHelp" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="price">Unit Price:</label>
            <input type="number" class="form-control" id="price" value="<?=$row1['price']?>" required>
            <small id="priceHelp" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label>Category:</label>
            <select id="category" name="category" required>
                <?php
                // Fetch the selected category
                $sql = "SELECT * FROM categories WHERE id='$catID'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "' selected>" . $row['category_name'] . "</option>";
                    }
                }

                // Fetch other categories
                $sql = "SELECT * FROM categories WHERE id!='$catID'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <small id="categoryHelp" class="text-danger"></small>
        </div>
        <div class="form-group">
            <img width='200px' height='150px' src='<?=$row1["cover_image"]?>' alt="Current Cover Image">
            <div>
                <label for="newImage">Choose New Image (Optional):</label>
                <input type="hidden" id="existingImage" value="<?=$row1['cover_image']?>">
                <input type="file" id="newImage">
                <small id="fileHelp" class="text-danger"></small>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Item</button>
        </div>
    </form>
    <?php
        }
    } else {
        echo "<p>No book found with the provided ISBN.</p>";
    }
    ?>
</div>
