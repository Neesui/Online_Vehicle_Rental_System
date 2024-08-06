<?php
// require_once "check_admin_login.php";
// require_once "function.php";

if (isset($_GET['b_id'])) {
    $id = $_GET['b_id'];

    if (!is_numeric($id)) {
        // header("Location: product_booking.php");
        exit;
    }

    require_once "connection.php";
    // Query to delete the booking
    $sql = "DELETE FROM customer WHERE c_id = $id";

    // Execute the delete query
    if ($connection->query($sql)) {
        // Redirect back to the view bookings page
        header("Location: ../product-booking.php");
        exit;
    } else {
        // Handle query execution error
        echo "Query error: " . $connection->error;
        exit;
    }
} else {
    // Redirect back to the view bookings page if 'id' parameter is not set
    // header("Location: product_booking.php");
    exit;
}
?>
