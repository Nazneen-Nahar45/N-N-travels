<?php
// Database credentials
$servername = "localhost";  // Usually 'localhost' for local servers
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "travel_booking"; // Your database name

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect and sanitize form inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $p_number = $conn->real_escape_string($_POST['p_number']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $age = (int)$_POST['age'];
    $destination = $conn->real_escape_string($_POST['destination']);
    $date = date('Y-m-d', strtotime($_POST['date']));
    $nid = $conn->real_escape_string($_POST['nid']);
    $agree = isset($_POST['agree']) ? 1 : 0;

    // Validate required fields
    if (empty($name) || empty($email) || empty($p_number) || empty($gender) || empty($age) || empty($destination) || empty($date) || empty($nid) || !$agree) {
        echo "All fields are required, and you must agree to the policy.";
    } else {
        // Prepare and execute the SQL query to insert data into the 'bookings' table
        $sql = "INSERT INTO bookings (name, email, p_number, gender, age, destination, travel_date, nid, agree) 
                VALUES ('$name', '$email', '$p_number', '$gender', $age, '$destination', '$date', '$nid', $agree)";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the home page after successful booking
            header("Location: success.html");
            exit(); // Stop further execution after redirect
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the MySQL connection
$conn->close();
?>
