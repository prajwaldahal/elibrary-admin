<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="./assets/css/style.css"></link>
  </head>
</head>
<body >
    
        <?php
            include "./adminHeader.php";
            include "./sidebar.php";
            include_once "./config/dbconnect.php";
        ?>

<div id="main-content" class="container allContent-section py-4">
    <div class="row">
        <div class="col-sm-3 mb-4">
            <div class="card bg-dark text-white text-center shadow">
                <div class="card-body">
                    <i class="fa fa-users mb-2" style="font-size: 70px;"></i>
                    <h4>Total Users</h4>
                    <h5>
                    <?php
                        $sql="SELECT * from users";
                        $result=$conn-> query($sql);
                        $count=0;
                        if ($result-> num_rows > 0){
                            while ($row=$result-> fetch_assoc()) {
                                $count++;
                            }
                        }
                        echo $count;
                    ?>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-sm-3 mb-4">
            <div class="card bg-primary text-white text-center shadow">
                <div class="card-body">
                    <i class="fa fa-th-large mb-2" style="font-size: 70px;"></i>
                    <h4>Total Categories</h4>
                    <h5>
                    <?php
                        $sql="SELECT * from categories";
                        $result=$conn-> query($sql);
                        $count=0;
                        if ($result-> num_rows > 0){
                            while ($row=$result-> fetch_assoc()) {
                                $count++;
                            }
                        }
                        echo $count;
                    ?>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-sm-3 mb-4">
            <div class="card bg-success text-white text-center shadow">
                <div class="card-body">
                    <i class="fa fa-th mb-2" style="font-size: 70px;"></i>
                    <h4>Total Books</h4>
                    <h5>
                    <?php
                        $sql="SELECT * from books";
                        $result=$conn-> query($sql);
                        $count=0;
                        if ($result-> num_rows > 0){
                            while ($row=$result-> fetch_assoc()) {
                                $count++;
                            }
                        }
                        echo $count;
                    ?>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-sm-3 mb-4">
            <div class="card bg-danger text-white text-center shadow">
                <div class="card-body">
                    <i class="fa fa-list mb-2" style="font-size: 70px;"></i>
                    <h4>Total Orders</h4>
                    <h5>
                    <?php
                        $sql="SELECT * from rental_transactions";
                        $result=$conn-> query($sql);
                        $count=0;
                        if ($result-> num_rows > 0){
                            while ($row=$result-> fetch_assoc()) {
                                $count++;
                            }
                        }
                        echo $count;
                    ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>

            
        <?php
            if (isset($_GET['category']) && $_GET['category'] == "success") {
                echo '<script> alert("Category Successfully Added")</script>';
            }else if (isset($_GET['category']) && $_GET['category'] == "error") {
                echo '<script> alert("Adding Unsuccess")</script>';
            }
            if (isset($_GET['size']) && $_GET['size'] == "success") {
                echo '<script> alert("Size Successfully Added")</script>';
            }else if (isset($_GET['size']) && $_GET['size'] == "error") {
                echo '<script> alert("Adding Unsuccess")</script>';
            }
            if (isset($_GET['variation']) && $_GET['variation'] == "success") {
                echo '<script> alert("Variation Successfully Added")</script>';
            }else if (isset($_GET['variation']) && $_GET['variation'] == "error") {
                echo '<script> alert("Adding Unsuccess")</script>';
            }
        ?>


    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>    
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</body>
 
</html>