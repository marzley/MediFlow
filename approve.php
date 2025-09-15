<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "MEDIC";

// Connect with mysql_* (for WAMP 2.0 / PHP 5.2–5.3)
$conn = mysql_connect($servername, $username, $password) 
    or die("Connection failed: " . mysql_error());
mysql_select_db($dbname, $conn);

// Approve logic
if (isset($_POST['email'])) {
    // sanitize input
    $email = mysql_real_escape_string($_POST['email']);

    $sql = "UPDATE appointments SET status='Approved' WHERE email='$email'";
    $result = mysql_query($sql, $conn);

    if (!$result) {
        die("Error updating: " . mysql_error());
    }
}

// Close connection
mysql_close($conn);

// Redirect back
header("Location: Booked.php");
exit;
?>
