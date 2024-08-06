<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header('location: index.php' );
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
	<link rel="stylesheet" type="text/css" href="dashboard.css">
	<title>Dashboard</title>
</head>
<body>
	<?php
		include_once 'maindashboard.php';

	?>

	<div id="D-main">
		<div class="D-head">
			<div class="col-div">
				<p>Dashboard</p>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col-div-1">
			<div class="D-Box">
				<i class="fa fa-user box-icons" id="icon-b"></i>
				<p id="num1"><a href="registereduser.php">Reg Customers</a></p>
			</div>
		</div>

		<div class="col-div-1">
			<div class="D-Box1">
				<i class="fa fa-file-photo-o" id="icon-c"></i>
				<p id="num1"><a href="list_vehicle.php">Listed Vehicles</a></p>
			</div>
		</div>

		<div class="col-div-1">
			<div class="D-Box2">
				<i class="fa fa-address-book" id="icon-c"></i>
				<p id="num1"><a href="list_booking.php">Total Booking</a></p>
			</div>
		</div>

		<div class="col-div-1">
			<div class="D-Box3">
				<i class="fa fa-motorcycle" id="icon-d"></i>
				<p id="num1"><a href="add_categories.php">Vehicle Categories</a></p>
			</div>
		</div>
		<div class="col-div-1">
			<div class="D-Box4">
				<i class="fa fa-automobile icons" id="icon-d"></i>
				<p id="num2"><a href="add-vehicle.php">Add Vehicle</a></p>
			</div>
		</div>
		<div class="col-div-1">
			<!-- <div class="D-Box5">
				<i class="fa fa-address-book-o" id="icon-d"></i>
				<p id="num1"><a href="">Manage Payment</a></p>
			</div> -->
		</div>
	</div>	
	
</body>
</html>