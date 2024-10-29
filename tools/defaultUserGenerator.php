<?php
    require_once "../config/dbconnect.php";
    echo "Loading.......................... </br>";
    $truncateSql = "TRUNCATE TABLE `admin`";
    if (!$conn->query($truncateSql) === TRUE) {
        die("Error creating default user " . $conn->error);
    }

    $plainPassword = 'pwd';
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
    $username = "admin";

    $sql = "INSERT INTO `admin` (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ss", $username, $hashedPassword);
        $stmt->execute();
        echo "Default user generated successfully.<br>";
    } else {
        die("Error creating default user " . $conn->error);
    }

    $stmt->close();
    $conn->close();
?>
