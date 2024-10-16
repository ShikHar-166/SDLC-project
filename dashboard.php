<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
  <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to bottom right, #1E90FF, #32CD32);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .centered-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        h1 {
            margin-bottom: 20px;
            color: #1E90FF;
        }

        a {
            display: block;
            padding: 10px 0;
            margin: 10px 0;
            background-color: #1E90FF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #32CD32;
        }

        .links-container {
            margin-top: 20px;
        
        }
    </style>
     <div class="centered-container">
    <div class="links-container">
<h1>Welcome to Finance Forge Dashboard</h1>
<a href="currency_converter.php">Currency Conversion</a>
<a href="quote_calculator.php">Investment Quotes</a>
<a href="export_csv.php">Export Data</a>
<a href="logout.php">Logout</a>
    </div>
    </div>
