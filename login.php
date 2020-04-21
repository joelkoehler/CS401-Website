<?php
session_start();
$_SESSION['email'] = "";
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Love is in the air!</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="icon" href="bird.jpg" type='image/x-icon'>
  </head>
  <header>
    <nav>
      <ul>
        <li><img src="bird.jpg" alt="bird haha" class="left-item logo"></li>
        <li><a href="index.html" class="left-item home-button">Home</a></li>
        <li><a href="profile-redirect.php" class="right-item account-button"><b>Account</b></a></li>
        <li><a href="cart.php" class="order-button">Place Order</a></li>
      </ul>
    </nav>
  </header>
  <body>
    <div class="login-wrapper">
      <div class="empty-row"></div>
      <div class="login-box">
        <h1 class="login-header">Login</h1>
        <div class="login-form-container">
          <form class="login-form" action="login_handler.php" method="post">
            <input type="text" name="EmailIn" placeholder="Email"><br>
            <input type="password" name="PasswordIn" placeholder="Password"><br>
            <input type="submit" name="login-submit" value="Submit" class="submit-button"><br>
          </form>
          <a href="signup.php" class="create-account-button">Don't have an account? <strong>Create one</strong></a>
          <?php
          session_start();
           echo "<br><span class=\"err\" style=\"background-color:red\">".$_SESSION['err']."</span>";
          ?>
        </div>
      </div>

      <div class="empty-row"></div>
    </div>
  </body>
  <footer>

  </footer>
</html>
