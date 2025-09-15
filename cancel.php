<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "MEDIC";

// connect with mysqli
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// cancel logic (using email OR id — depending on your form)
if (isset($_POST['email'])) {
    $email = $_POST['email']; // email is string
    
    // use ? placeholder for prepared statement
    $sql = "UPDATE appointments SET status='Cancelled' WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // "s" because email is string
    
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: Booked.php");
exit;
?>
