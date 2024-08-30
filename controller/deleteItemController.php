<?php

    include_once "../config/dbconnect.php";
    
    $p_id=$_POST['record'];
    $query="DELETE FROM books where isbn_no='$p_id'";

    $data=mysqli_query($conn,$query);

    if($data){
        echo"books Item Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>