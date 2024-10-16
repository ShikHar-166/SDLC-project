<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Finance Forge</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: linear-gradient(to bottom right, #1E90FF, #32CD32);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .navbar {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
        }

        .logo {
            font-size: 28px;
            color: #1E90FF;
            font-weight: 700;
            margin-left: 25px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.1);
        }

        .navbar ul {
            list-style-type: none;
            display: flex;
            margin-right: 25px;
        }

        .navbar ul li {
            margin-left: 25px;
        }

        .navbar ul li a {
            text-decoration: none;
            font-size: 18px;
            color: #1E90FF;
            transition: color 0.3s ease, border-bottom 0.3s ease;
            border-bottom: 2px solid transparent;
            padding-bottom: 3px;
        }

        .navbar ul li a:hover {
            color: #32CD32;
            border-bottom: 2px solid #32CD32;
        }

        .centered-container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: 400px;
            margin-top: 120px; /* Adjust to leave space for navbar */
            animation: fadeIn 1s ease;
        }

        h1 {
            margin-bottom: 30px;
            color: #1E90FF;
            font-size: 32px;
            font-weight: 600;
        }

        button {
            background-color: #1E90FF;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin: 15px;
            box-shadow: 0 5px 15px rgba(30, 144, 255, 0.3);
        }

        button:hover {
            background-color: #32CD32;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(50, 205, 50, 0.3);
        }

        button:active {
            transform: scale(0.98);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Finance Forge</div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <div class="centered-container">
        <h1>Welcome to Finance Forge</h1>
        <a href="register.php"><button>Register</button></a>
        <a href="login.php"><button>Login</button></a>
    </div>
</body>
</html>
