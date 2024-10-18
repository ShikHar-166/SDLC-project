<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$currencies = ["GBP", "USD", "EUR", "BRL", "JPY", "TRY"];
$rates = [ 
    "GBP" => 1.0,
    "USD" => 1.39,
    "EUR" => 1.17,
    "BRL" => 7.02,
    "JPY" => 151.16,
    "TRY" => 19.85
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from = $_POST['from_currency'];
    $to = $_POST['to_currency'];
    $amount = $_POST['amount'];

    
    if ($amount < 300 || $amount > 5000) {
        $error = "Transaction amount must be between 300 and 5000.";
    } else {
       
        $converted = ($amount / $rates[$from]) * $rates[$to];

        
        if ($amount <= 500) {
            $fee = 0.035 * $amount;
        } elseif ($amount <= 1500) {
            $fee = 0.027 * $amount;
        } elseif ($amount <= 2500) {
            $fee = 0.02 * $amount;
        } else {
            $fee = 0.015 * $amount;
        }

        $final_amount = $converted - $fee;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link rel="stylesheet" href="style.css">
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
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #333;
        }

        select, input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #1E90FF;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #32CD32;
        }

        p {
            font-size: 14px;
            color: #333;
            margin-top: 20px;
        }

        p.error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="centered-container">
        <h1>Currency Converter</h1>
        <form method="post">
            <label>From: </label>
            <select name="from_currency">
                <?php foreach ($currencies as $currency) { ?>
                    <option value="<?= $currency ?>"><?= $currency ?></option>
                <?php } ?>
            </select><br>

            <label>To: </label>
            <select name="to_currency">
                <?php foreach ($currencies as $currency) { ?>
                    <option value="<?= $currency ?>"><?= $currency ?></option>
                <?php } ?>
            </select><br>

            <input type="number" name="amount" placeholder="Amount" required><br>
            <button type="submit">Convert</button>
        </form>

        <?php if (isset($error)) { ?>
            <p style="color:red"><?= $error ?></p>
        <?php } elseif (isset($final_amount)) { ?>
            <p>Converted Amount: <?= round($final_amount, 2) ?> <?= $to ?> (Fees: <?= round($fee, 2) ?>)</p>
        <?php } ?>
    </div>
</body>
</html>
