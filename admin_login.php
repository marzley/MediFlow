<?php require_once('Connections/MEDIC.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['admin_id'])) {
  $loginUsername=$_POST['admin_id'];
  $password=$_POST['admin_password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "Booked.php";
  $MM_redirectLoginFailed = "adminregister.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MEDIC, $MEDIC);
  
  $LoginRS__query=sprintf("SELECT id, password FROM register WHERE id='%s' AND password='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $MEDIC) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #007bff 0%, #00c6ff 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 400px;
            margin: 80px auto;
            padding: 40px 36px 32px 36px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            position: relative;
        }
        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 28px;
            letter-spacing: 1px;
        }
        nav {
            text-align: center;
            margin-bottom: 28px;
        }
        nav a {
            color: #007bff;
            text-decoration: none;
            margin: 0 18px;
            font-weight: 600;
            font-size: 16px;
            transition: color 0.2s;
        }
        nav a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #b3d1ff;
            border-radius: 6px;
            font-size: 15px;
            background: #f8fbff;
            transition: border 0.2s;
        }
        form input[type="text"]:focus,
        form input[type="password"]:focus {
            border: 1.5px solid #007bff;
            outline: none;
            background: #eaf4ff;
        }
        form input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #007bff 60%, #00c6ff 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,123,255,0.08);
            transition: background 0.2s, box-shadow 0.2s;
        }
        form input[type="submit"]:hover {
            background: linear-gradient(90deg, #0056b3 60%, #009ec3 100%);
            box-shadow: 0 4px 16px rgba(0,123,255,0.12);
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #fff;
            font-size: 14px;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <nav>
            <a href="index.html">Home</a> |
            <a href="about.html">About Us</a>|
            <a href="adminregister.php">Admin Register</a>
        </nav>
        <form action="<?php echo $loginFormAction; ?>" method="POST">
            <label for="admin_id">Admin ID:</label>
            <input type="text" name="admin_id" id="admin_id" required autocomplete="username">
            <label for="admin_password">Password:</label>
            <input type="password" name="admin_password" id="admin_password" required autocomplete="current-password">
            <input type="submit" value="Login">
        </form>
    </div>
    <div class="footer">
        &copy; <?php echo date("Y"); ?> Medic System. All rights reserved.
    </div>
</body>
</html>