<?php
session_start();
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Love is in the air!</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="signup.css">
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
        <h1 class="login-header">Sign up</h1>
        <div class="login-form-container">
          <form class="login-form" action="signup_handler.php" method="post">
            <input type="text" name="EmailIn" value='<?php
            if (!empty($_SESSION['email'])) {
              echo $_SESSION['email'];
            }
            else {
              echo "Email";
            }
            ?>'>
            <br>
            <input type="password" name="PasswordIn" placeholder="Make Password"><br>
            <input type="submit" name="signup-submit" value="Submit" class="submit-button"><br>
          </form>
          <a href="login.php" class="create-account-button">Already have an account? <strong>Sign in</strong></a>
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
