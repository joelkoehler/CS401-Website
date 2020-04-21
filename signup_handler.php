<?php
session_start();
$email = $_POST['EmailIn'];
$password = $_POST['PasswordIn'];
require_once "Dao.php";
$dao = new Dao();
$pass = true;
$_SESSION['err'] = "";

if (!empty($email)) {
  $_SESSION['email'] = $email;
}

// checks for input
if (empty($email) || !preg_match_all("/[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9\-]+.[a-zA-Z]+/", $email)) {
  //EMAIL FAIL
  $_SESSION['err'] .= "Invalid Email: must match this format: [alpha-numeric (including _ - . +)]@[alpha-numeric (including -)].[alpha-numeric]\n";
  $pass = false;
}
if (strlen($password) < 8 || $password == 'null') {
  $_SESSION['err'] .= "Invalid Password: must be 8 or more characters long";
  $pass = false;
}
if ($pass) {
  // execute and redirect
  $yes = $dao->saveUser($email, $password);
  if ($yes) {
    header("Location: ../login.php");
    $_SESSION['err'] = "";
    $_SESSION['email'] = "";
  }
  else {
    header("Location: ../signup.php");
    $_SESSION['err'] = "Email in use already";
  }
  exit;
}
else {
  header("Location: ../signup.php");
  exit;
}
