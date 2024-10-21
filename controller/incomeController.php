<?php
include_once "../config/dbconnect.php";
$currentYear = date('Y');
$selectedYear = isset($_POST['yearSelected']) ? $_POST['yearSelected'] : $currentYear;
$chart = isset($_POST['chart']) ? $_POST['chart'] : false;
$year = isset($_POST['year']) ? $_POST['year'] : false;

if ($chart && !$year) {
    $sql = "
        SELECT
            DATE_FORMAT(date, '%b') AS month,
            SUM(total_income) AS total_income
        FROM (
            SELECT
                rental_date AS date,
                amount_paid AS total_income
            FROM
                rental_transactions
            WHERE
                YEAR(rental_date) = $selectedYear

            UNION ALL

            SELECT
                rented_date AS date,
                price AS total_income
            FROM
                rented_books_history
            WHERE
                YEAR(rented_date) = $selectedYear
        ) AS combined
        GROUP BY
            MONTH(date),
            DATE_FORMAT(date, '%b')
        ORDER BY
            MONTH(date);
    "; 
    $result = $conn->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else if ($chart && $year) {
    $sql = "
        SELECT 
            YEAR(date) AS year, 
            COALESCE(SUM(total_income), 0) AS total_income 
        FROM 
            ( 
                SELECT rental_date AS date,
                    amount_paid AS total_income 
                FROM rental_transactions 

                UNION ALL 

                SELECT rented_date AS date,
                    price AS total_income 
                FROM rented_books_history 
            ) AS combined 
        GROUP BY YEAR(date) 
        ORDER BY YEAR(date);
    "; 
    $result = $conn->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {    
    $totalIncomeQuery = "
        SELECT COALESCE(SUM(amount), 0) AS total_income
        FROM (
            SELECT COALESCE(rt.amount_paid, 0) AS amount
            FROM rental_transactions rt

            UNION ALL

            SELECT COALESCE(rbh.price, 0) AS amount
            FROM rented_books_history rbh
        ) AS combined;
    ";

    $totalIncomeResult = $conn->query($totalIncomeQuery);
    $totalIncome = $totalIncomeResult->fetch_assoc()['total_income'];

    $activeIncomeQuery = "
        SELECT COALESCE(SUM(rt.amount_paid), 0) AS active_income
        FROM rental_transactions rt 
        WHERE rt.expiry_date >= CURDATE();
    ";
    $activeIncomeResult = $conn->query($activeIncomeQuery);
    $activeIncome = $activeIncomeResult->fetch_assoc()['active_income'];

    $historyIncomeQuery = "
        SELECT COALESCE(SUM(price), 0) AS history_income 
        FROM rented_books_history;
    ";
    $historyIncomeResult = $conn->query($historyIncomeQuery);
    $historyIncome = $historyIncomeResult->fetch_assoc()['history_income'];

    $monthIncomeQuery = "
        SELECT COALESCE(SUM(amount_paid), 0) AS month_income 
        FROM (
            SELECT amount_paid 
            FROM rental_transactions 
            WHERE MONTH(rental_date) = MONTH(CURDATE()) 
            AND YEAR(rental_date) = YEAR(CURDATE())
            
            UNION ALL
            
            SELECT price AS amount_paid 
            FROM rented_books_history 
            WHERE MONTH(rented_date) = MONTH(CURDATE()) 
            AND YEAR(rented_date) = YEAR(CURDATE())
        ) AS month_income;
    ";
    $monthIncomeResult = $conn->query($monthIncomeQuery);
    $monthIncome = $monthIncomeResult->fetch_assoc()['month_income'];

    $response = [
        'total_income' => $totalIncome,
        'active_income' => $activeIncome,
        'history_income' => $historyIncome,
        'month_income' => $monthIncome
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
