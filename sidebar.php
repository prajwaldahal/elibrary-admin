
<div class="sidebar" id="mySidebar">
    <div class="side-header">
        <img src="./assets/images/logo.png" width="120" height="120" alt="Swiss Collection"> 
        <h5 style="margin-top:10px; color: #fff;">Hello, Admin</h5>
    </div>

    <hr style="border:1px solid #fff;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="./dashboard.php"><i class="fa fa-tachometer"></i> Dashboard</a>
    <a href="#income" onclick="showIncome()"><i class="fa fa-money"></i> Income</a>
    <a href="#books" onclick="showBooks()"><i class="fa fa-book"></i> Books</a>
    <a href="#notifications" id="notification-link" onclick="showNotifications()" class="notification">
        <i class="fa fa-bell"></i> Notification
        <span id="notification-badge" class="badge" style="display: none;"></span>
    </a>
    <a href="#rentedbook" onclick="showRental()"><i class="fa fa-archive"></i> Rented Books</a>
    <a href="#requested" onclick="showRequested()"><i class="fa fa-paper-plane"></i> Requested Books</a>
    <a href="#customers" onclick="showCustomers()"><i class="fa fa-users"></i> Customers</a>
    <a href="#history" onclick="showHistory()"><i class="fa fa-history"></i> History</a>
    <a href="#category" onclick="showCategory()"><i class="fa fa-tags"></i> Categories</a>
</div>

<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-bars"></i></button>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script>
    function checkUnreadNotifications() {
        $.ajax({
            url: 'controller/notificationController.php',
            method: 'Post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.total_notifications > 0) {
                    $('#notification-badge').text(data.total_notifications).show();
                    alert('new '+data.total_notifications +' notifications are available');
                } else {
                    $('#notification-badge').hide();
                }
            },
            error: function(xhr) {
                console.error('Error fetching notifications'+xhr.responseText);
            }
        });
    }
    checkUnreadNotifications();    
    setInterval(checkUnreadNotifications, 30000);
</script>
