<?php
session_start();

$action = $_POST['action'];
$locationPath = "";

if ('login' === $action) {
  $_SESSION['email']    = $_POST['email'];
  $_SESSION['password'] = $_POST['password'];
  
  $locationPath = 'Location: ../login/login.php';

} else if ('registration' === $action) {
  $locationPath = 'Location: ../../view/registration/registration.php';
}

header($locationPath);
exit();
?>