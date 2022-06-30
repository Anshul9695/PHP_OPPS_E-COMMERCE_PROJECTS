<?php
session_start();
//echo "welcome to the dashboard".$_SESSION['email'];
$email=$_SESSION['email'];
echo $email;
?>