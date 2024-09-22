<?php
    require '../config/dbconnect.php'; 
    // updateNotifications();
    // viewNotifications();

    function totalNotifications(){
        global $conn;
        $query = "SELECT COUNT(*) AS total_notifications FROM admin_notification WHERE is_read = 0";
        $result =  mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }
    function updateNotifications(){
        global $conn;
        $query = "SELECT COUNT(*) AS total_notifications FROM admin_notification WHERE is_read = 0";
        $result =  mysqli_query($conn,$query);
        if(!$result){
            http_response_code(500);
            $message = array(
                'update' => 'false',
            );
            header('Content-Type: application/json');
            echo json_encode($message); 
        }
        else{
            $message = array(
                'update' => 'true',
            );
            header('Content-Type: application/json');
            echo json_encode($message); 
        }   
    }

    function viewNotifications(){
        global $conn;
        $query = "SELECT COUNT(*) AS total_notifications FROM admin_notification WHERE is_read = 0";
        $result =  mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }

    totalNotifications();


?>
