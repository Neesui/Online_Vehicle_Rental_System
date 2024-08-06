<?php
	// process to login into datsbase
	$connection = new mysqli('localhost','root','','online_vehicle_rental');
	if ($connection->connect_error != 0) {
		die(" Database connection errror :" . $connection->connect_error);
}
?>