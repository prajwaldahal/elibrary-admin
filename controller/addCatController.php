<?php
    include_once "../config/dbconnect.php";
    
    if(isset($_POST['upload']))
    {
        $catname = $_POST['c_name'];

        $query = "INSERT INTO categories (category_name) VALUES ('$catname')";
       
        $insert = mysqli_query($conn, $query);

        if(!$insert)
        {
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "message" => "Failed to add record."
            ]);
        }
        else
        {
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "message" => "Records added successfully."
            ]);
        }
    }
    else
    {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid request."
        ]);
    }
?>
