<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('location: userlogin.php' );
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@800&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../style.css">
  <title>Dashboard</title>
</head>
<body>
  <?php
    include_once 'user-main-dashboard.php';

  ?>

  <div id="D-main">
    <div class="D-head">
      <div class="col-div">
        <h3 class="userdashboardh6">Email:<?php echo $_SESSION['email'] ?></h3> 
        <h1>Welcome</h1>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-div-1">
      <div class="D-Box2">
        <i class="fa fa-user" id="icon-c"></i>
        <p id="num1"><a href="user_profile.php">My Profile</a></p>
      </div>
    </div>
    <div class="col-div-1">
      <div class="D-Box3">
        <i class="fa fa-address-book" id="icon-c"></i>
        <p id="num1"><a href="user_view_booking.php">My Booking</a></p>
      </div>
    </div>
  </div>  
  
</body>
</html>