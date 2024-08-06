
<?php 
//mysqli function, mysqli class, PDO (PHP Data Object)
error_reporting(E_ERROR);
try{
	$id = $_GET['vehicle_id'];
	$connection = mysqli_connect('localhost','root','','online_vehicle_rental');
	$sql = "DELETE from vehicle where vehicle_id=$id";
	($connection);
	mysqli_query($connection,$sql);
	if ($connection->affected_rows > 0) {
		// echo '<script>alert("Successfully Deletes the Vehicle");</script>';
		// header('location:list_vehicle.php');
	}
}catch(Exception $e){
	die('Connection Error: ' . $e->getMessage());
}

 ?>