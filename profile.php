<?php
session_start();
if (!$_SESSION['auth']) {
  header("Location: ../login.php");
  exit;
}
require_once 'Dao.php';
$dao = new Dao();

?>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Love is in the air!</title>
      <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="profile.css">
      <link rel="icon" href="bird.jpg" type='image/x-icon'>
    </head>
    <header>
      <nav>
        <ul>
          <li><img src="bird.jpg" alt="bird haha" class="logo"></li>
          <li><a href="index.html" class="home-button">Home</a></li>
          <li><a href="profile-redirect.php" class="account-button"><b>Account</b></a></li>
          <li><a href="cart.php" class="order-button">Place Order</a></li>
        </ul>
      </nav>
    </header>
    <body>
      <div class="welcome-wrapper">
        <div class="empty-row"></div>
        <div class="welcome-header">
          <h1>Your Account</h1>
        </div>
      </div>
      <div class="order-wrapper">
        <form class="order-form" action="logout-handler.php" method="post">
          <a href="cart.php" class="new-purchase-button">Send a Pigeon</a>
          <input type="submit" name="Logout" value="Logout" class="logout-button"><br>
        </form>
        <h2>Your orders</h2>
        <table>
          <tr>
            <th>ItemCode (100 = standard, 200 = expedited)</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Message</th>
          </tr>
          <?php
          $lines = $dao->getOrders();
          if(!empty($lines)) {
            foreach ($lines as $line) {
              echo
              "<tr>
              <td>" . $line['ItemCode'] . "</td>
              <td>" . $line['Latitude'] . "</td>
              <td>" . $line['Longitude'] . "</td>
              <td>" . $line['Message'] . "</td>
              </tr>\n";
            }
          }
          else {
            echo "No orders.";
          }

          ?>
        </table>

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
