<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
    <div class="side-header">
        <img src="./assets/images/logo.png" width="120" height="120" alt="Swiss Collection"> 
        <h5 style="margin-top:10px; color: #fff;">Hello, Admin</h5>
    </div>

    <hr style="border:1px solid #fff;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="./index.php"><i class="fa fa-tachometer"></i> Dashboard</a>
    <a href="#income" onclick="showIncome()"><i class="fa fa-money"></i> Income</a>
    <a href="#books" onclick="showBooks()"><i class="fa fa-book"></i> Books</a>
    <a href="#notifications" onclick="showNotifications()" class="notification">
        <i class="fa fa-bell"></i> Notification</a>
    <a href="#customers" onclick="showCustomers()"><i class="fa fa-users"></i> Customers</a>
    <a href="#history" onclick="showHistory()"><i class="fa fa-history"></i> History</a>
    <a href="#rentedbook" onclick="showRental()"><i class="fa fa-archive"></i> Rented Books</a>
    <a href="#requested" onclick="showRequested()"><i class="fa fa-paper-plane"></i> Requested Books</a>
    <a href="#category" onclick="showCategory()"><i class="fa fa-tags"></i> Categories</a>
</div>

<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-bars"></i></button>
</div>
