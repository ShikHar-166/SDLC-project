<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Set headers to download the file as CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=investment_quotes.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'Investment', 'Plan', 'Earnings', 'Total Amount', 'Quote Date'));

// Retrieve the logged-in user's quotes
$query = "SELECT * FROM investment_quotes WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

// Loop through the results and output them as CSV rows
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
?>
