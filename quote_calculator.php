<?php
session_start();
include 'db_connection.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

function calculate_investment($investment, $monthly, $plan) {
    $rate_min = 0;
    $rate_max = 0;
    $tax_rate_1 = 0.10; 
    $tax_rate_2 = 0.20; 
    $fees_rate = 0;

    switch ($plan) {
        case 'basic_savings':
            $rate_min = 0.012;
            $rate_max = 0.024;
            $fees_rate = 0.0025;
            break;

        case 'savings_plus':
            $rate_min = 0.03;
            $rate_max = 0.055;
            $fees_rate = 0.003;
            break;

        case 'managed_stock':
            $rate_min = 0.04;
            $rate_max = 0.23;
            $fees_rate = 0.013;
            break;

        default:
            throw new Exception("Invalid investment plan selected.");
    }

    $investment_details = [];
    $periods = [1, 5, 10]; 

    foreach ($periods as $years) {
        $total_investment = $investment + ($monthly * 12 * $years);
        $min_return = $total_investment * pow(1 + $rate_min, $years) - $total_investment;
        $max_return = $total_investment * pow(1 + $rate_max, $years) - $total_investment;

        $total_fees = $total_investment * $fees_rate * $years;

        
        $tax_min = 0;
        $tax_max = 0;

        if ($plan === 'managed_stock') {
            if ($min_return > 40000) {
                $tax_min = ($min_return - 40000) * $tax_rate_2 + (40000 - 12000) * $tax_rate_1;
            } elseif ($min_return > 12000) {
                $tax_min = ($min_return - 12000) * $tax_rate_1;
            }

            if ($max_return > 40000) {
                $tax_max = ($max_return - 40000) * $tax_rate_2 + (40000 - 12000) * $tax_rate_1;
            } elseif ($max_return > 12000) {
                $tax_max = ($max_return - 12000) * $tax_rate_1;
            }
        } else {
           
            $tax_min = max(0, $min_return - 12000) * $tax_rate_1;
            $tax_max = max(0, $max_return - 12000) * $tax_rate_1;
        }

        
        $investment_details[$years] = [
            'min_return' => $min_return,
            'max_return' => $max_return,
            'total_fees' => $total_fees,
            'tax_min' => $tax_min,
            'tax_max' => $tax_max,
            'total_min_value' => $investment + $min_return - $total_fees - $tax_min,
            'total_max_value' => $investment + $max_return - $total_fees - $tax_max,
        ];
    }

    return $investment_details;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $initial_investment = $_POST['investment'];
    $monthly_investment = $_POST['monthly'];
    $plan = $_POST['plan'];

    
    if ($initial_investment <= 0 || $monthly_investment <= 0) {
        echo "Invalid input values. Please enter valid numbers.";
        exit();
    }

    
    switch ($plan) {
        case 'basic_savings':
            if ($monthly_investment < 50) {
                echo "Minimum monthly investment for Basic Savings Plan is £50.";
                exit();
            }
            $yearly_investment = $initial_investment + ($monthly_investment * 12);
            if ($yearly_investment > 20000) {
                echo "Maximum investment per year for Basic Savings Plan is £20,000.";
                exit();
            }
            break;

        case 'savings_plus':
            if ($initial_investment < 300) {
                echo "Minimum initial investment for Savings Plan Plus is £300.";
                exit();
            }
            if ($monthly_investment < 50) {
                echo "Minimum monthly investment for Savings Plan Plus is £50.";
                exit();
            }
            $yearly_investment = $initial_investment + ($monthly_investment * 12);
            if ($yearly_investment > 30000) {
                echo "Maximum investment per year for Savings Plan Plus is £30,000.";
                exit();
            }
            break;

        case 'managed_stock':
            if ($initial_investment < 1000) {
                echo "Minimum initial investment for Managed Stock Investments is £1,000.";
                exit();
            }
            if ($monthly_investment < 150) {
                echo "Minimum monthly investment for Managed Stock Investments is £150.";
                exit();
            }
            break;

        default:
            echo "Invalid investment plan selected.";
            exit();
    }

    
    $quote = calculate_investment($initial_investment, $monthly_investment, $plan);

    
    $query = "INSERT INTO investment_quotes (user_id, investment, plan, details) 
              VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $details = json_encode($quote);
    $stmt->bind_param("isss", $_SESSION['user_id'], $initial_investment, $plan, $details);
    $stmt->execute();

    
    $_SESSION['quote_details'] = $quote;
    header("Location: quote_results.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment Quote Calculator</title>
    <link rel="stylesheet" href="style.css">
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to bottom right, #1E90FF, #32CD32);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .centered-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="number"],
        select {
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            font-size: 14px;
            color: red;
        }
    </style>
    </head>
<body>
    <div class="centered-container">
        <h1>Investment Quote Calculator</h1>
        <form method="POST">
            <label>Enter Initial Investment (£):</label>
            <input type="number" name="investment" required><br>

            <label>Enter Monthly Investment (£):</label>
            <input type="number" name="monthly" required><br>

            <label>Select Plan:</label>
            <select name="plan" required>
                <option value="basic_savings">Basic Savings Plan</option>
                <option value="savings_plus">Savings Plan Plus</option>
                <option value="managed_stock">Managed Stock Investments</option>
            </select><br>

            <button type="submit">Get Quote</button>
        </form>

       
        <?php if (isset($error)) { ?>
            <p style="color:red"><?= $error ?></p>
        <?php } ?>
    </div>
</body>
</html>
