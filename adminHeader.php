<?php
   if (session_status() == PHP_SESSION_NONE) {
        session_start();
    };
   include_once "./config/dbconnect.php";
?>
       
<nav class="navbar navbar-expand-lg navbar-light px-5" style="background-color: #34495E;">
    <a class="navbar-brand ml-5" href="./dashboard.php">
        <img src="./assets/images/logo.png" width="80" height="80" alt="PP">
    </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
    
    <div>  
        <div id="logoutIcon" style="text-decoration:none;" data-toggle="tooltip" title="Sign Out">
            <i class="fa fa-sign-in mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
        </div>
    </div>  
</nav>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){
    $('[data-toggle="Logout"]').tooltip();

    $('#logoutIcon').click(function(event) {
        event.preventDefault();
        let confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            window.location.href = 'logout.php';
        }
    });
});
</script>