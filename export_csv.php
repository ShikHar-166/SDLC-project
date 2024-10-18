<?php
session_start();
include 'db_connection.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=investment_quotes.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'Investment', 'Plan', 'Earnings', 'Total Amount', 'Quote Date'));


$query = "SELECT * FROM investment_quotes WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();


while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
?>
