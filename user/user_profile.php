 <?php

 session_start();
// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit;
}

// Fetch and display the booking data for the logged-in user
$c_id = $_SESSION['c_id'];

error_reporting(E_ERROR);

include_once "connection.php";
$sql = "SELECT customer.full_Name, customer.Address, customer.email, customer.Phone_Number FROM customer WHERE c_id = '$c_id'";
// $sql = "SELECT booking.Full_Name, booking.Email, booking.Address, booking.Phone_Number FROM booking where c_id = '$c_id'";
$res = mysqli_query($connection, $sql);
$data = [];

if ($res->num_rows > 0) {
    while ($r = mysqli_fetch_assoc($res)) {
        array_push($data, $r);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
 
 
    <?php
    include_once('user-main-dashboard.php');
    ?>
    <div class="up">
    <p>Profile</p>
    </div>

        <div class="container">
        <?php foreach ($data as $key => $user) { ?>

        <fieldset class="uborder">    

        <h1 id="uname"><?php echo $user['full_Name'] ?></h1>
        <p><b>Address :</b>&nbsp;&nbsp;<?php echo $user['Address'] ?></p>
        <p><b>Email :</b>&nbsp;&nbsp;<?php echo $user['email'] ?></p>
        <p><b>Phone Number :</b>&nbsp;&nbsp;<?php echo $user['Phone_Number'] ?></p>

        <!-- <a href="update-profile.php?c_id=<?php echo $user['c_id'] ?>"><input type="submit" name="Btnupdate" value="Update Profile"></a> -->
        <!-- <a href="update-profile.php" class="edit">Update</a> -->

    </fieldset>
        <?php } ?>
    </div>
</body>

</html>
