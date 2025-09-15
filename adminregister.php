<?php require_once('Connections/MEDIC.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO register (id, email, password) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['admin_id'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_MEDIC, $MEDIC);
  $Result1 = mysql_query($insertSQL, $MEDIC) or die(mysql_error());

  $insertGoTo = "register_success.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts for sleek look -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #2980b9, #6dd5fa, #ffffff);
            font-family: 'Roboto', sans-serif;
            margin: 0;
            min-height: 100vh;
        }
        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(41, 128, 185, 0.95);
            padding: 18px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            animation: slideDown 1s cubic-bezier(.68,-0.55,.27,1.55);
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 28px;
            font-size: 1.1rem;
            font-weight: 500;
            position: relative;
            transition: color 0.3s;
        }
        .navbar a::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #fff;
            transition: width .3s;
            position: absolute;
            left: 0;
            bottom: -5px;
        }
        .navbar a:hover {
            color: #6dd5fa;
        }
        .navbar a:hover::after {
            width: 100%;
        }
        @keyframes slideDown {
            from { transform: translateY(-60px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .container {
            max-width: 400px;
            margin: 60px auto;
            background: rgba(255,255,255,0.95);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(41,128,185,0.15);
            padding: 36px 32px 28px 32px;
            animation: fadeInUp 1.2s cubic-bezier(.68,-0.55,.27,1.55);
        }
        @keyframes fadeInUp {
            from { transform: translateY(40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        h2 {
            text-align: center;
            color: #2980b9;
            margin-bottom: 28px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        label {
            display: block;
            margin-bottom: 7px;
            color: #2980b9;
            font-weight: 500;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1px solid #b2bec3;
            border-radius: 7px;
            font-size: 1rem;
            transition: border 0.3s, box-shadow 0.3s;
            outline: none;
        }
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
            border: 1.5px solid #2980b9;
            box-shadow: 0 2px 8px rgba(41,128,185,0.08);
        }
        button {
            width: 100%;
            padding: 12px 0;
            background: linear-gradient(90deg, #2980b9, #6dd5fa);
            color: #fff;
            border: none;
            border-radius: 7px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(41,128,185,0.13);
            transition: background 0.3s, transform 0.2s;
            margin-top: 10px;
        }
        button:hover {
            background: linear-gradient(90deg, #6dd5fa, #2980b9);
            transform: translateY(-2px) scale(1.03);
        }
        @media (max-width: 500px) {
            .container {
                padding: 24px 10px 18px 10px;
            }
            .navbar a {
                margin: 0 12px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="aboutus.php">About Us</a>
        <a href="services.php">Services</a>
    </nav>
    <div class="container">
        <h2>Admin Registration</h2>
        <form name="form1" action="<?php echo $editFormAction; ?>" method="POST" autocomplete="off">
            <label for="admin_id">Admin ID</label>
            <input type="text" id="admin_id" name="admin_id" required placeholder="Enter your ID">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password">

            <button type="submit">Register</button>
            <input type="hidden" name="MM_insert" value="form1">
      </form>
</div>
</body>
</html>