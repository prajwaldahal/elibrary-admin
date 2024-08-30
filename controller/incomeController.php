<?php
include_once "../config/dbconnect.php";
$currentMonth = date('m');
$currentYear = '20'.date('y');
$selectedYear = isset($_POST['year']) ? $_POST['year'] : date('Y');
$chart = isset($_POST['chart']) ? $_POST['chart'] : false;

// Fetch data
if ($chart) {
    // Fetch monthly data for the chart
    $sql = "SELECT
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
    MONTH(date)
ORDER BY
    MONTH(date);
"; 
    $result = $conn->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    $sql = "SELECT
    -- Total income from both tables
    COALESCE(SUM(rt.amount_paid), 0) + COALESCE((SELECT SUM(price) FROM rented_books_history), 0) AS total_income,
    
    -- Active income from rental_transactions
    COALESCE(SUM(CASE WHEN rt.expiry_date >= CURDATE() THEN rt.amount_paid ELSE 0 END), 0) AS active_income,
    
    -- Total income from rented_books_history
    COALESCE((SELECT SUM(price) FROM rented_books_history), 0) AS history_income,
    
    -- Income for the current month and year from both tables
    COALESCE(SUM(combined.amount_paid), 0) AS month_income
FROM
    rental_transactions rt
LEFT JOIN (
    -- Combine income from both tables for the current month and year
    SELECT 
        amount_paid
    FROM 
        rental_transactions
    WHERE 
        MONTH(rental_date) = $currentMonth 
        AND YEAR(rental_date) = $currentYear

    UNION ALL

    SELECT 
        price AS amount_paid
    FROM 
        rented_books_history
    WHERE 
        MONTH(rented_date) = $currentMonth
        AND YEAR(rented_date) = $currentYear
) AS combined
ON 1 = 1
";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    echo json_encode($data);
}

?>
