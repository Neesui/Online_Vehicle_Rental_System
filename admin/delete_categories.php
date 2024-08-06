
<?php 
//mysqli function, mysqli class, PDO (PHP Data Object)
error_reporting(E_ERROR);
try{
	$id = $_GET['category_id'];
	$connection = mysqli_connect('localhost','root','','online_vehicle_rental');
	$sql = "DELETE from categories where category_id=$id";
	print_r($connection);
	mysqli_query($connection,$sql);
	if ($connection->affected_rows > 0) {
		echo '<script>alert("Successfully Deletes the Categories");</script>';
		header('location:list_categories.php');
	}
}catch(Exception $e){
	die('Connection Error: ' . $e->getMessage());
}

 ?>