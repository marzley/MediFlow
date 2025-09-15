<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "MEDIC";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$appointment = null;

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $result = $conn->query("SELECT * FROM appointments WHERE email='$email'");
    $appointment = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #e0f7fa 0%, #f4f4f4 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .edit-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.15);
            padding: 40px 32px 32px 32px;
            max-width: 420px;
            width: 100%;
            animation: fadeInUp 0.8s;
        }
        h2 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 30px;
            letter-spacing: 1px;
            font-weight: 700;
            animation: fadeIn 1s;
        }
        label {
            font-weight: 500;
            color: #1e3557;
            margin-bottom: 6px;
            display: block;
        }
        input[type="text"], input[type="date"], input[type="time"], select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1px solid #cfd8dc;
            border-radius: 6px;
            font-size: 1em;
            background: #f7fafc;
            transition: border 0.2s, box-shadow 0.2s;
        }
        input[type="text"]:focus, input[type="date"]:focus, input[type="time"]:focus, select:focus {
            border: 1.5px solid #007BFF;
            box-shadow: 0 2px 8px rgba(0,123,255,0.08);
            outline: none;
        }
        button[type="submit"] {
            width: 100%;
            background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
            color: #fff;
            border: none;
            padding: 12px 0;
            border-radius: 6px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(67,233,123,0.08);
            transition: background 0.2s, transform 0.2s;
            margin-top: 10px;
            letter-spacing: 1px;
        }
        button[type="submit"]:hover {
            background: linear-gradient(90deg, #38f9d7 0%, #43e97b 100%);
            transform: translateY(-2px) scale(1.03);
        }
        .fade-in {
            animation: fadeIn 1s;
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(40px);}
            100% { opacity: 1; transform: translateY(0);}
        }
        @keyframes fadeIn {
            0% { opacity: 0;}
            100% { opacity: 1;}
        }
        .not-found {
            color: #ff5858;
            text-align: center;
            font-size: 1.1em;
            margin-top: 30px;
            animation: fadeIn 1s;
        }
        .main-nav {
            display: flex;
            gap: 24px;
            background: #fff;
            padding: 18px 32px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(44,62,80,0.07);
            margin: 24px auto 32px auto;
            max-width: 700px;
            justify-content: center;
            align-items: center;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #007BFF;
            text-decoration: none;
            font-size: 1.08em;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 6px;
            transition: background 0.18s, color 0.18s, transform 0.18s;
        }
        .nav-link i {
            font-size: 1.1em;
        }
        .nav-link:hover, .nav-link.active {
            background: linear-gradient(90deg, #e0f7fa 0%, #b2ebf2 100%);
            color: #0056b3;
            transform: translateY(-2px) scale(1.04);
        }
    </style>
</head>

<body>


<div class="edit-container">
    <nav class="main-nav">
    <a href="index.html" class="nav-link"><i class="fas fa-home"></i> Home</a>
    <a href="about.html" class="nav-link"><i class="fas fa-users"></i> About Us</a>
</nav>
<h2>Edit Appointment</h2>



<?php if ($appointment): ?>
<form method="post" action="update.php" class="fade-in">
    <input type="hidden" name="email" value="<?php echo $appointment['email']; ?>">

    <label>Name:</label>
    <input type="text" name="full_name" value="<?php echo $appointment['full_name']; ?>">

    <label>Phone:</label>
    <input type="text" name="phone" value="<?php echo $appointment['phone']; ?>">

    <label>Date:</label>
    <input type="date" name="appointment_date" value="<?php echo $appointment['appointment_date']; ?>">

    <label>Time:</label>
    <input type="time" name="appointment_time" value="<?php echo $appointment['appointment_time']; ?>">

    <label>Reason:</label>
    <input type="text" name="reason" value="<?php echo $appointment['reason']; ?>">

    <label>Status:</label>
    <select name="status">
        <option <?php if($appointment['status']=="Pending") echo "selected"; ?>>Pending</option>
        <option <?php if($appointment['status']=="Approved") echo "selected"; ?>>Approved</option>
        <option <?php if($appointment['status']=="Cancelled") echo "selected"; ?>>Cancelled</option>
        <option <?php if($appointment['status']=="Completed") echo "selected"; ?>>Completed</option>
    </select>

    <button type="submit">Update</button>
</form>
<?php else: ?>
    <p class="not-found">Appointment not found.</p>
<?php endif; ?>
</div>
</body>
</html>
