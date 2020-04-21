<?php
include('Dao.php');
  session_start();
  $email = $_POST['EmailIn'];
  $password = $_POST['PasswordIn'];
  $dao = new Dao();
  $_SESSION['err'] = "";

// checks for input
if (empty($email) || empty($password) || $email == 'null' || $password == 'null') {
  $_SESSION['err'] = "No fields may be left blank";
  header("Location: ../login.php");
}
else {
  $yes = $dao->emailExists($email);
  if ($yes) {
     $match = $dao->passwordMatches($email, $password);
      if ($match) {
        $_SESSION['auth'] = true;
        $_SESSION['userid'] = $dao->getUserID($email);
        header("Location: ../cart.php");
        $_SESSION['err'] = "";
        exit;
      }
      else {
        header("Location: ../login.php");
        $_SESSION['err'] = "Invalid username or password";
        exit;
      }
  }
  else {
    $_SESSION['auth'] = false;
    $_SESSION['err'] = "Invalid username or password";
    header("Location: ../login.php");
  }
  exit;
}
