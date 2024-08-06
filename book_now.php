<?php
session_start(); // Start or resume the session

if (isset($_SESSION['c_id'])) {
    // The user is logged in, include the 'user/index.php' file
    include('user/index.php');
} else {
    // The user is not logged in, include the 'product-booking.php' file
    include('product-booking.php');
}
?>
