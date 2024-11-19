<!-- admin_booking.php -->
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle logout request
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle DELETE request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $conn->query("DELETE FROM bookings WHERE id = $delete_id");
    header("Location: admin_booking.php");
}

// Handle UPDATE request
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $p_number = $_POST['p_number'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $destination = $_POST['destination'];
    $travel_date = $_POST['travel_date'];
    $nid = $_POST['nid'];

    $sql = "UPDATE bookings SET 
            name='$name', 
            email='$email', 
            p_number='$p_number',
            gender='$gender',
            age=$age,
            destination='$destination',
            travel_date='$travel_date',
            nid='$nid'
            WHERE id=$update_id";
    
    $conn->query($sql);
    header("Location: admin_booking.php");
}

$result = $conn->query("SELECT * FROM bookings");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Booking Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="
    font-family: Arial, sans-serif; 
    background-color: #e3f2fd; 
    margin: 0; 
    padding: 20px;
    display: flex; 
    justify-content: center; 
    align-items: center; 
    min-height: 100vh;
">

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

    <div style="background-color: #fff; padding: 30px; border-radius: 10px; max-width: 1200px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="text-align: center; color: #007BFF; margin-bottom: 20px;">Manage Bookings</h1>

        <form method="POST" action="admin_booking.php" style="text-align: center; margin-bottom: 20px;">
            <input type="submit" name="logout" value="Logout" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px;">
        </form>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; background-color: #fff; border-radius: 8px;">
                <thead>
                    <tr style="background-color: #007BFF; color: white; border-radius: 5px;">
                        <th style="padding: 15px; border: 1px solid #ddd;">ID</th>
                        <th style="padding: 15px; border: 1px solid #ddd;">Name</th>
                        <th style="padding: 15px; border: 1px solid #ddd;">Email</th>
                        <th style="padding: 15px; border: 1px solid #ddd;">Phone</th>
                        <th style="padding: 15px; border: 1px solid #ddd;">Gender</th>
                        <th style="padding: 15px; border: 1px solid #ddd;">Age</th>
                        <th style="padding: 15px; border: 1px solid #ddd;">Destination</th>
                        <th style="padding: 15px; border: 1px solid #ddd;">Travel Date</th>
                        <th style="padding: 15px; border: 1px solid #ddd;">NID</th>
                        <th style="padding: 15px; border: 1px solid #ddd;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr style="background-color: #f9f9f9; border-bottom: 1px solid #ddd;">
                        <form method="POST" action="admin_booking.php">
                            <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['id']; ?></td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="name" value="<?php echo $row['name']; ?>" required style="width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 5px;"></td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><input type="email" name="email" value="<?php echo $row['email']; ?>" required style="width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 5px;"></td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="p_number" value="<?php echo $row['p_number']; ?>" required style="width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 5px;"></td>
                            <td style="padding: 10px; border: 1px solid #ddd;">
                                <select name="gender" style="width: 100%; padding: 5px; border: 1px solid #ccc; border-radius: 5px;">
                                    <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                    <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                </select>
                            </td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><input type="number" name="age" value="<?php echo $row['age']; ?>" required style="width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 5px;"></td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="destination" value="<?php echo $row['destination']; ?>" required style="width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 5px;"></td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><input type="date" name="travel_date" value="<?php echo $row['travel_date']; ?>" required style="width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 5px;"></td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="nid" value="<?php echo $row['nid']; ?>" required style="width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 5px;"></td>
                            <td style="padding: 10px; border: 1px solid #ddd;">
                                <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Update" style="background-color: #28a745; color: white; border: none; padding: 8px 16px; cursor: pointer; border-radius: 5px;"><br>
                                <a href="admin_booking.php?delete_id=<?php echo $row['id']; ?>" style="color: #dc3545; text-align:center; text-decoration: none; margin-left: 10px;"><h2>Delete</h2></a>
                            </td>
                        </form>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
