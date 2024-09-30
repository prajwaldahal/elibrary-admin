<style>
    .info {
        background-color: #d1ecf1; 
    }

    .rented {
        background-color: #d4edda;
    }

    .expired {
        background-color: #f8d7da;
    }

    .reported {
        background-color: #fff3cd;
    }
</style>

<div id="ordersBtn">
  <h2>Notifications</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Created At</th>
        <th>Type</th>
        <th>Notifications</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include_once "../config/dbconnect.php";
      $sql = "SELECT * FROM admin_notification ORDER BY created_at DESC";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $notification_type = $row["notification_type"];
              $class = '';
              
              switch ($notification_type) {
                  case 'info':
                      $class = 'info';
                      break;
                  case 'rented':
                      $class = 'rented';
                      break;
                  case 'expired':
                      $class = 'expired';
                      break;
                  case 'reported':
                      $class = 'reported';
                      break;
              }
      ?>
      <tr class="<?= $class ?>">
        <td class="text-center align-middle"><?= $row["created_at"] ?></td>
        <td class="text-center align-middle"><?= ucfirst($notification_type) ?></td>
        <td class="text-center align-middle"><?= $row["message"] ?></td>
      </tr>
      <?php
          }
      } else {
          echo "<tr><td colspan='3' class='text-center'>Sorry, no new notifications are available</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>
