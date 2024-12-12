<div >
  <h2>All Users</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">UserID</th>
        <th class="text-center">Name</th>
        <th class="text-center">Email</th>
        <th class="text-center">Joining Date</th>
  
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from users";
      $result=$conn-> query($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$row["id"]?></td>
      <td><?=$row["full_name"]?></td>
      <td><?=$row["email"]?></td>
      <td><?=$row["registration_date"]?></td>
    </tr>
    <?php
           
        }
    }
    ?>
  </table>