<div class="container mt-4">
    <div class="row d-flex justify-content-between align-items-center mb-4">
        <h2 class="col-auto">Books Items</h2>
        <div class="col-auto">
          
            <button type="button" class="btn btn-primary d-flex align-items-center" 
                    data-toggle="modal" data-target="#myModal"
                    style="border-radius: 15px; padding: 20px 30px; font-weight: bold; 
                           transition: background-color 0.3s ease-in-out, transform 0.2s;">
                Add Book
            </button>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">Image</th>
                <th class="text-center">ISBN No</th>
                <th class="text-center">Title</th>
                <th class="text-center">Author</th>
                <th class="text-center">Description</th>
                <th class="text-center">Category</th>
                <th class="text-center">Rent</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once "../config/dbconnect.php";
            $sql = "SELECT * FROM books, categories WHERE books.category_id = categories.id AND books.is_deleted = 0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td class="text-center align-middle"><img height='200px' src='<?= $row["cover_image"] ?>' alt="Book Cover"></td>
                <td class="text-center align-middle"><?= $row["isbn_no"] ?></td>
                <td class="text-center align-middle"><?= $row["title"] ?></td>
                <td class="text-center align-middle"><?= $row["author"] ?></td>
                <td class="text-center align-middle"><?= $row["description"] ?></td>
                <td class="text-center align-middle"><?= $row["category_name"] ?></td>
                <td class="text-center align-middle"><?= $row["price"] ?></td>
                <td class="text-center align-middle">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary btn-sm mr-2" onclick="itemEditForm('<?= $row['isbn_no'] ?>')">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="itemDelete('<?= $row['isbn_no'] ?>')">Delete</button>
                    </div>
                </td>
            </tr>

            <?php
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>No books found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Book Item</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="bookForm" enctype="multipart/form-data" method="POST" onsubmit="return addItems()">
                    <div class="form-group">
                        <label for="isbn">ISBN No:</label>
                        <input type="text" class="form-control" name="isbn_no" id="isbn" required>
                        <small id="isbnHelp" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="name">Title:</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        <small id="nameHelp" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                        <small id="priceHelp" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description:</label>
                        <textarea class="form-control" name="desc" id="desc" rows="4" placeholder="Enter description here..." required></textarea>
                        <small id="descHelp" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="author">Author:</label>
                        <input type="text" class="form-control" name="author" id="author" required>
                        <small id="authorHelp" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Category:</label>
                        <select id="category" name="category" class="form-control" required>
                            <option disabled selected>Select category</option>
                            <?php
                            $sql = "SELECT * FROM categories";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <small id="categoryHelp" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="file">Choose Image:</label>
                        <input type="file" class="form-control-file" name="file" id="file" required>
                        <small id="fileHelp" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary" name="upload"  style="border-radius: 15px;  font-weight: bold; 
                           transition: background-color 0.3s ease-in-out, transform 0.2s;" >Add Items</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-success:hover {
        background-color: #28a745 !important;
        transform: scale(1.05);
    }
</style>