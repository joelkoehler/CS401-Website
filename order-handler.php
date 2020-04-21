<?php
include('Dao.php');
  session_start();
  $package = $_POST['Package'];
  $lat = $_POST['Lat'];
  $lon = $_POST['Lon'];
  $message = $_POST['Message'];
  require_once "Dao.php";
  $dao = new Dao();
  $pass = true;
  if (!empty($package)) {
    $_SESSION['pack'] = $package;
  }
  if (!empty($lat)) {
    $_SESSION['lat'] = $lat;
  }
  if (!empty($lat)) {
    $_SESSION['lon'] = $lon;
  }
  if (!empty($message)) {
    $_SESSION['message'] = $message;
  }

  // checks for input
  if (empty($package) || empty($lat) || empty($lon) || empty($message) || $lat == 'null' || $lon == 'null' || $message == 'null') {
    $_SESSION['err'] = "No fields may be left blank";
    header("Location: ../cart.php");
    $pass = false;
    exit;
  }
  if (strlen($message) > 500) {
    $_SESSION['err'] .= "Message must be less than 500 characters\n";
    header("Location: ../cart.php");
    $pass = false;
    exit;
  }
  if (strlen($lat) > 11 || !preg_match('/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/', $lat)) {
    $_SESSION['err'] .= "Invalid Latitude: must be a decimal value between -90 and 90\n";
    header("Location: ../cart.php");
    $pass = false;
    exit;
  }
  if (strlen($lon) > 11 || !preg_match('/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/', $lon)) {
    $_SESSION['err'] .= "Invalid Longitude: must be a decimal value between -180 and 180\n";
    header("Location: ../cart.php");
    $pass = false;
    exit;
  }
  if($pass) {
    $dao->saveOrder($package, $lat, $lon, $message, $_SESSION['userid']); //$_SESSION['userid']
    header("Location: ../cart.php");
    $_SESSION['err'] = "";
    $_SESSION['pack'] = "";
    $_SESSION['lat'] = "";
    $_SESSION['lon'] = "";
    $_SESSION['message'] = "";
    exit;
  }
