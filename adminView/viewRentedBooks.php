<div id="ordersBtn" >
  <h2>Rental Details</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>R.N.</th>
        <th>ISBN NO</th>
        <th>title</th>
        <th>User Id</th>
        <th>Name</th>
        <th>Rented On</th>
        <th>Expires On</th>
        <th>Payment</th>
     </tr>
    </thead>
    <tbody>
            <?php
            include_once "../config/dbconnect.php";
            $sql = "SELECT 
                    rental_transactions.id,               
                    rental_transactions.isbn_no,       
                    books.title,                         
                    rental_transactions.user_id,   
                    users.full_name,                  
                    rental_transactions.rental_date, 
                    rental_transactions.expiry_date, 
                    rental_transactions.amount_paid,  
                    DATEDIFF(rental_transactions.expiry_date, CURDATE()) AS days_until_expiry     
                FROM 
                    rental_transactions
                JOIN 
                    books ON rental_transactions.isbn_no = books.isbn_no
                JOIN 
                    users ON rental_transactions.user_id = users.id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td class="text-center align-middle"><?= $row["id"] ?></td>
                <td class="text-center align-middle"><?= $row["isbn_no"] ?></td>
                <td class="text-center align-middle"><?= $row["title"] ?></td>
                <td class="text-center align-middle"><?= $row["user_id"] ?></td>
                <td class="text-center align-middle"><?= $row["full_name"] ?></td>
                <td class="text-center align-middle"><?= $row["rental_date"] ?></td>
                <td class="text-center align-middle">
                <div class="col">
                    <div><?= $row["expiry_date"] ?></div>
                    <small class="<?= $row["days_until_expiry"] < 15 ? 'text-danger' : 'text-success' ?>">
                        <?= $row["days_until_expiry"] ?> days remaining
                    </small>
                </div>
            </td>
                <td class="text-center align-middle"><?= $row["amount_paid"] ?></td>
            </tr>

            <?php
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>Sorry No books are on Rent</td></tr>";
            }
            ?>
        </tbody>
    </table>