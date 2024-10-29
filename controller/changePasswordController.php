<?php
    include_once "../config/dbconnect.php";
    // session_start();
    // if (!isset($_SESSION['user'])) {
    //     http_response_code(500);
    //     echo json_encode(["status" => "error", "message" => "User not authenticated."]);
    //     exit();
    // }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
        $currentPassword = trim($_POST['current_password']);
        $newPassword = trim($_POST['new_password']);
        $confirmPassword = trim($_POST['confirm_password']);
        //$userId = $_SESSION['user']!;

        $sql = "SELECT password FROM `admin`";
        $stmt = $conn->prepare($sql);
        //$stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($currentPassword, $user['password'])) {
                if ($newPassword === $confirmPassword) {
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updateSql = "UPDATE `admin` SET `password` = ?";
                    $updateStmt = $conn->prepare($updateSql);
                    $updateStmt->bind_param("s", $hashedNewPassword); //, $userId);
                    if ($updateStmt->execute()) {
                        http_response_code(200);
                        echo json_encode(["status" => "success", "message" => "Password changed successfully."]);
                    } else {
                        http_response_code(500);
                        echo json_encode(["status" => "error", "message" => "Failed to change password. Please try again."]);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(["status" => "error", "message" => "New password and confirm password do not match."]);
                }
            } else {
                http_response_code(401);
                echo json_encode(["status" => "error", "message" => "Current password is incorrect."]);
            }
        } else {
            http_response_code(404);
            echo json_encode(["status" => "error", "message" => "User not found."]);
        }
    }
?>
