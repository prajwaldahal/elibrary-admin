<?php
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    
   if(session_destroy())
     header('Location:login.php');
?>