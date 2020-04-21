<?php
session_start();
if ($_SESSION['auth']) {
  header("Location: ../profile.php");
  exit;
}
else {
  header("Location: ../login.php");
  exit;
}
