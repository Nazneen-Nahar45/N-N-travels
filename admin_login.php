<!-- admin_login.php -->
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin12345") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_booking.php");
    } else {
        $error_message = "Invalid Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1e3c72, #2a5298); /* Dark blue gradient */
            color: #fff;
        }

        /* Login Form Styling */
        .login-container {
            background: rgba(0, 0, 0, 0.8); /* Semi-transparent background */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #fff;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #ddd;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        /* Error message */
        p.error {
            color: #ff4d4d;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>

<div id="menu-bar" class="fas fa-bars"></div>

<a href="http://localhost/Tour and Travel/index.html" class="logo"><span>N & N </span>Travel</a>

<nav class="navbar">
<a href="./travel.html">home</a>
    <a href="http://localhost/Tour and Travel/index.html">book</a>
    <a href="./travel.html">packages</a>
    <a href="./travel.html">services</a>
    <a href="./travel.html">gallery</a>
    <a href="./travel.html">review</a>
    <a href="./travel.html">contact</a>
</nav>

<div class="icons">
    <i class="" id="search-btn"></i>
    <i class="" id="login-btn"></i>
</div>

<form action="" class="search-bar-container">
    <input type="search" id="search-bar" placeholder="search here...">
    <label for="search-bar" class="fas fa-search"></label>
</form>

</header>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="admin_login.php">
            <label for="username"><h1>Username:</h1></label>
            <input type="text" id="username" name="username" required>
            <label for="password"><h1>Password:</h1></label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
