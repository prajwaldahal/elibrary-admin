<div id="ordersBtn" >
  <h2>Rental Details</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>R.N.</th>
        <th>ISBN NO</th>
        <th>title</th>
        <th>Customer id</th>
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
                    rented_books_history.id,               
                    rented_books_history.isbn_no,       
                    books.title,                         
                    rented_books_history.user_id,   
                    users.full_name,                  
                    rented_books_history.rented_date, 
                    rented_books_history.expired_date, 
                    rented_books_history.price    
                FROM 
                    rented_books_history
                JOIN 
                    books ON rented_books_history.isbn_no = books.isbn_no
                JOIN 
                    users ON rented_books_history.user_id = users.id";
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
                <td class="text-center align-middle"><?= $row["rented_date"] ?></td>
                <td class="text-center align-middle"><?= $row["expired_date"] ?></td>
                <td class="text-center align-middle"><?= $row["price"] ?></td>
            </tr>

            <?php
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>Sorry No books</td></tr>";
            }
            ?>
        </tbody>
    </table>