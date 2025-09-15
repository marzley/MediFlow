<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "MEDIC";

// Use mysqli for modern PHP (works with WAMP 2.0+)
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (
    isset($_POST['email']) &&
    isset($_POST['full_name']) &&
    isset($_POST['phone']) &&
    isset($_POST['appointment_date']) &&
    isset($_POST['appointment_time']) &&
    isset($_POST['reason']) &&
    isset($_POST['status'])
) {
    // Sanitize input
    $email = $conn->real_escape_string($_POST['email']);
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $date = $conn->real_escape_string($_POST['appointment_date']);
    $time = $conn->real_escape_string($_POST['appointment_time']);
    $reason = $conn->real_escape_string($_POST['reason']);
    $status = $conn->real_escape_string($_POST['status']);

    // Update the appointment
    $sql = "UPDATE appointments SET 
                full_name='$full_name',
                phone='$phone',
                appointment_date='$date',
                appointment_time='$time',
                reason='$reason',
                status='$status'
            WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        header("Location: Booked.php?msg=updated");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<a href="index.html" class="back-home-btn" title="Back to Home">
    <i class="fas fa-home"></i> Home
</a>