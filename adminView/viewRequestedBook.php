<div class="container mt-4">
    <div class="row d-flex justify-content-between align-items-center mb-4">
        <h2 class="col-auto">Requested Books</h2>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">Request ID</th>
                <th class="text-center">ISBN</th>
                <th class="text-center">Title</th>
                <th class="text-center">User ID</th>
                <th class="text-center">Full Name</th>
                <th class="text-center">Request Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once "../config/dbconnect.php";
            $sql = "SELECT rb.request_id, rb.isbn, rb.title, rb.user_id, u.full_name, rb.request_date 
                    FROM requestedbook rb
                    JOIN users u ON rb.user_id = u.id AND rb.is_deleted=0";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td class="text-center align-middle"><?= $row["request_id"] ?></td>
                <td class="text-center align-middle"><?= $row["isbn"] ?></td>
                <td class="text-center align-middle"><?= $row["title"] ?></td>
                <td class="text-center align-middle"><?= $row["user_id"] ?></td>
                <td class="text-center align-middle"><?= $row["full_name"] ?></td>
                <td class="text-center align-middle"><?= $row["request_date"] ?></td>
            </tr>

            <?php
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No requested books found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
