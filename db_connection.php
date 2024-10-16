<?php
$conn = mysqli_connect("localhost:3306", "root", "", "finance_forge");
if (mysqli_connect_errno()) {
    echo "Connection failed: " . mysqli_connect_error();
    exit();
}
?>
