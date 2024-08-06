<?php
$email = $_POST['checkemail'];
include_once('connection.php');
$sql = "SELECT * FROM customer WHERE email = '$email'";
$result = $connection->query($sql);
if ($result->num_rows == 1) {
    echo 'Email already exists';
} else {
    echo '';
}
?>
