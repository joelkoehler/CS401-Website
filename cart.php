<?php
session_start();
if (!$_SESSION['auth']) {
  header("Location: ../login.php");
  exit;
}

?>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Love is in the air!</title>
      <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="cart.css">
      <link rel="icon" href="bird.jpg" type='image/x-icon'>
    </head>
    <header>
      <nav>
        <ul>
          <li><img src="bird.jpg" alt="bird haha" class="logo"></li>
          <li><a href="index.html" class="home-button">Home</a></li>
          <li><a href="profile-redirect.php" class="account-button">Account</a></li>
          <li><a href="cart.php" class="order-button"><b>Place Order</b></a></li>
        </ul>
      </nav>
    </header>
    <body>
      <div class="welcome-wrapper">
        <div class="empty-row"></div>
        <div class="welcome-header">
          <h1>Your Order</h1>
        </div>
      </div>
      <div class="order-wrapper">
        <form class="order-form" action="order-handler.php" method="post">
          <input type="radio" name="Package" value='std' id="std">
          <label for="std">Standard Package</label><br>
          <input type="radio" name="Package" value='exp' id="exp">
          <label for="exp">Expidited Package</label><br>
          <input onClick="this.select();" type="text" name="Lat" value=
          '<?php
          if (!empty($_SESSION['lat'])) {
            echo $_SESSION['lat'];
          }
          else {
            echo "Recipiant Latitude";
          }
          ?>'>
          <br>
          <input onClick="this.select();" type="text" name="Lon" value=
          '<?php
          if (!empty($_SESSION['lon'])) {
            echo $_SESSION['lon'];
          }
          else {
            echo "Recipiant Longitude";
          }
          ?>'>
          <br>
          <input onClick="this.select();" class="message-box" type="text" name="Message" value=
          '<?php
          if (!empty($_SESSION['message'])) {
            echo $_SESSION['message'];
          }
          else {
            echo "Type your message here";
          }
          ?>'>
          <br>
          <input type="submit" name="confirm" value="Confirm Order" class="confirm-button"><br>
        </form>
        <?php
        //session_start();
        if (!empty($_SESSION['err'])) {
          echo "<br><span class=\"err\" style=\"background-color:red\">".$_SESSION['err']."</span>";
        }
        ?>
      </div>
    </body>
    <footer>

    </footer>
  </html>
