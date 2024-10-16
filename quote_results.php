<?php
session_start();
if (!isset($_SESSION['quote_details'])) {
    header("Location: investment.php");
    exit();
}

$quote = $_SESSION['quote_details'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment Quote Results</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: linear-gradient(to bottom right, #1E90FF, #32CD32);
            margin: 0;
            padding: 20px;
            color: #fff;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }

        .results-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .result-box {
            background-color: rgba(255, 255, 255, 0.15);
            border: 2px solid #fff;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            margin: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .result-box h3 {
            margin-top: 0;
            color: #fff;
        }

        .highlighted {
            font-weight: bold;
            font-size: 1.5em;
            color: #FFD700; /* Highlight in gold */
        }

        .value {
            font-size: 1.2em;
            color: #fff;
        }
    </style>
</head>
<body>

<h1>Investment Quote Results</h1>

<div class="results-container">
    <?php foreach ($quote as $years => $details) { ?>
        <div class="result-box">
            <h3><?php echo $years; ?> Year Plan</h3>
            <p>Minimum Return: <span class="highlighted">£<?php echo number_format($details['min_return'], 2); ?></span></p>
            <p>Maximum Return: <span class="highlighted">£<?php echo number_format($details['max_return'], 2); ?></span></p>
            <p>Total Fees: <span class="value">£<?php echo number_format($details['total_fees'], 2); ?></span></p>
            <p>Minimum Tax: <span class="value">£<?php echo number_format($details['tax_min'], 2); ?></span></p>
            <p>Maximum Tax: <span class="value">£<?php echo number_format($details['tax_max'], 2); ?></span></p>
            <p>Total Value (Min Return): <span class="highlighted">£<?php echo number_format($details['total_min_value'], 2); ?></span></p>
            <p>Total Value (Max Return): <span class="highlighted">£<?php echo number_format($details['total_max_value'], 2); ?></span></p>
        </div>
    <?php } ?>
</div>

</body>
</html>
