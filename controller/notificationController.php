<?php
require '../config/dbconnect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update']) && $_POST['update'] === 'true') {
        updateNotifications();
    } else {
        totalNotifications();
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}

function totalNotifications() {
    global $conn;
    $query = "SELECT COUNT(*) AS total_notifications FROM admin_notification WHERE is_read = 0";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch notifications']);
    }
}

function updateNotifications() {
    global $conn;
    $query = "UPDATE admin_notification SET is_read = 1";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        http_response_code(500);
        echo json_encode(['update' => 'false']);
    } else {
        echo json_encode(['update' => 'true']);
    }
}
?>
