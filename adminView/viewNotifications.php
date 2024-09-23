<style>
    .info {
        background-color: #d1ecf1; /* Light blue */
    }

    .rented {
        background-color: #d4edda; /* Light green */
    }

    .expired {
        background-color: #f8d7da; /* Light red */
    }

    .reported {
        background-color: #fff3cd; /* Light yellow */
    }

    /* Optional: Add some padding and border to make it look cleaner */
    td, th {
        padding: 10px;
        border: 1px solid #ddd;
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
      $sql = "SELECT * FROM admin_notification WHERE is_read=0 ORDER BY created_at DESC";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              // Get the notification type and assign the appropriate class
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
          echo "<tr><td colspan='8' class='text-center'>Sorry, no Notifications Available</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>
