<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_MEDIC = "localhost";
$database_MEDIC = "medic";
$username_MEDIC = "root";
$password_MEDIC = "";
$MEDIC = mysql_pconnect($hostname_MEDIC, $username_MEDIC, $password_MEDIC) or trigger_error(mysql_error(),E_USER_ERROR); 
?>