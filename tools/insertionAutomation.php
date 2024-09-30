<?php
include_once "../config/dbconnect.php";

$isbn_list = [];
$sql = "SELECT isbn_no FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $isbn_list[] = $row['isbn_no'];
    }
} else {
    die("No ISBNs found in the books table.");
}

function randomDate($start_date, $end_date) {
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);
    $random_timestamp = mt_rand($start_timestamp, $end_timestamp);
    return date("Y-m-d", $random_timestamp);
}

for ($i = 0; $i < 150; $i++) {
    $user_id = rand(10001, 10010);
    $isbn_no = $isbn_list[array_rand($isbn_list)];
    $rental_date = randomDate('2022-06-01', '2024-09-22');
    $expiry_date = randomDate('2024-10-10', '2025-02-30');
    $amount_paid = number_format(rand(5000, 30000) / 100, 2);

    $sql = "INSERT INTO rental_transactions (user_id, isbn_no, rental_date, expiry_date, amount_paid)
            VALUES ('$user_id', '$isbn_no', '$rental_date', '$expiry_date', '$amount_paid')";

    if ($conn->query($sql) === TRUE) {
        echo $i." Record inserted successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
