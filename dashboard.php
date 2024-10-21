<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['user'])){
        echo "user is nt set";
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css"></link>
</head>
<body>

    <?php
        include "./adminHeader.php";
        include "./sidebar.php";
        include_once "./config/dbconnect.php";
    ?>

    <div id="main-content" class="container allContent-section py-4">


        <div class="row mt-5">
            <div class="col-sm-3 mb-4">
                <div class="card bg-dark text-white text-center shadow">
                    <div class="card-body">
                        <i class="fa fa-users mb-2" style="font-size: 70px;"></i>
                        <h4>Total Users</h4>
                        <h5>
                        <?php
                            $sql="SELECT count(*) as total_users from users";
                            $result=$conn-> query($sql);
                            echo $result-> fetch_assoc()['total_users'];
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
                            $sql="SELECT count(*) as total_cat from categories";
                            $result=$conn-> query($sql);
                            echo $result-> fetch_assoc()['total_cat'];
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
                            $sql="SELECT count(*) as total_books from books";
                            $result=$conn-> query($sql);
                            echo $result-> fetch_assoc()['total_books'];
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
                            $sql="SELECT
                                COALESCE(SUM(total_orders), 0) AS total_orders
                                FROM
                                    (
                                        SELECT COUNT(*) AS total_orders
                                        FROM rental_transactions
                                        UNION ALL
                                        SELECT COUNT(*) AS total_orders
                                        FROM rented_books_history
                                    ) AS combined;
                                ";
                            $result=$conn-> query($sql);
                            echo $result-> fetch_assoc()['total_orders'];
                        ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col mb-4">
            <div class="col-sm-6 mb-4">
                    <form method="POST" class="form-inline">
                        <label class="mr-2" for="chartType">Select Chart Type:</label>
                        <select id="yearChartType" class="form-control">
                            <option value="LineChart">Line Chart</option>
                            <option value="PieChart">Pie Chart</option>
                            <option value="ColumnChart">Column Chart</option>
                            <option value="BarChart">Bar Chart</option>
                        </select>
                    </form>
                </div>
                <div class="col-md-12 mb-4">
                    <div id="yearly_income_chart" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>

    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback( loadYearlyIncomeChart);
        $('#yearChartType').on('change', function() {
            loadYearlyIncomeChart();
        });
    </script>
</body>
</html>
