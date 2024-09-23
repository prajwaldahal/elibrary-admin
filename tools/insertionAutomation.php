<?php
// Connect to the database
include_once "../config/dbconnect.php"; // Assuming this file contains your DB connection

// Fetch all ISBN numbers from the books table
$isbn_list = [];
$sql = "SELECT isbn_no FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $isbn_list[] = $row['isbn_no']; // Add each ISBN to the array
    }
} else {
    die("No ISBNs found in the books table.");
}

// Function to generate random dates
function randomDate($start_date, $end_date) {
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);
    $random_timestamp = mt_rand($start_timestamp, $end_timestamp);
    return date("Y-m-d", $random_timestamp);
}

for ($i = 0; $i < 100; $i++) {
    $user_id = rand(10001, 10010); // User IDs between 10001 and 10010
    $isbn_no = $isbn_list[array_rand($isbn_list)]; // Select a random ISBN from the list
    $rental_date = randomDate('2022-01-01', '2024-09-09'); // Random date between 2022 and 2024-09-09
    $expiry_date = randomDate('2024-10-01', '2025-12-31'); // Expiry date >= 2024-10-01
    $amount_paid = number_format(rand(5000, 30000) / 100, 2); // Random amount between 50.00 and 300.00

    // Prepare and execute the SQL query
    $sql = "INSERT INTO rental_transactions (user_id, isbn_no, rental_date, expiry_date, amount_paid)
            VALUES ('$user_id', '$isbn_no', '$rental_date', '$expiry_date', '$amount_paid')";

    if ($conn->query($sql) === TRUE) {
        echo $i."Record inserted successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
