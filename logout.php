<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">    <title>Logout</title>
</head>
<body>
    <div class="container">
        <h1>You have been logged out</h1>
        <p>Redirecting to the homepage...</p>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "index.php";
        }, 2000); // Redirect after 2 seconds
    </script>
</body>
</html>
