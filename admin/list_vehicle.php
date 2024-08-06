<?php 
//mysqli function, mysqli class, PDO (PHP Data Object)
error_reporting(E_ERROR);
try{
	$connection = mysqli_connect('localhost','root','','online_vehicle_rental');
	$sql = "select * from vehicle";
	$res = mysqli_query($connection,$sql);
	$data = [];
	// print_r($res);
	if ($res->num_rows > 0) {
		while ($r = mysqli_fetch_assoc($res)) {
			array_push($data, $r);
		}
	}
	// print_r($data);
}catch(Exception $e){
	die('Connection Error: ' . $e->getMessage());
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
	<title>List of Vehicle</title>
	<link rel="stylesheet" type="text/css" href="dashboard.css">
</head>
<body>
	<?php
		include_once('maindashboard.php');

	?>
	<div class="list">
		<h1 class="h1list">List of Vehicle</h1>
			<div>
		
			</div>
		<table  class="tablestyle">
			<tr>
				<th>SN</th>
				<th>Vehicle Name</th>
				<th>Vehicle fuel</th>
				<th>Status</th>
				<th>Action</th>


			</tr>
			<?php foreach ($data as $key => $add_vehicle) { ?>
				<tr>
					<td><?php echo $add_vehicle['vehicle_id'] ?></td>
					<td><?php echo $add_vehicle['Vehicle_name'] ?></td>
					<!-- <td><?php echo $add_vehicle['model'] ?></td> -->
					<td><?php echo $add_vehicle['fuel'] ?></td>
					<!-- <td><?php echo $add_vehicle['seat'] ?></td>
					<td><?php echo $add_vehicle['price'] ?></td>
					<td><img src="uploads/<?php echo $add_vehicle['image'] ?>"width="50px" height="50px"></td>
					<td><?php echo $add_vehicle['message'] ?></td>
					<td><?php echo $add_vehicle['created_by'] ?></td>
					<td><?php echo $add_vehicle['created_at'] ?></td>
					<td><?php echo $add_vehicle['updated_by'] ?></td>
					<td><?php echo $add_vehicle['updated_at'] ?></td> -->
					<td><?php if($add_vehicle['status'] == 1) { ?>
						<span class="success">Active</span>
						<?php } else {?>
						<span class="un-success">In-Active</span></td>
						<?php } ?>
					<td class="actioncol">
	                    <a href="update_vehicle.php?vehicle_id=<?php echo $add_vehicle['vehicle_id']?>" class="edit">Update</a>
                    	<a href="delete_vehicle.php?vehicle_id=<?php echo $add_vehicle['vehicle_id']?>" class="del" onclick="return confirm('are you sure to delete?')">Delete</a>
	                    <a href="view_vehicle.php?vehicle_id=<?php echo $add_vehicle['vehicle_id']?>" class="view">View</a>
                </td>
				</tr>
			<?php } ?>
		</table>
		<!-- <a href="add_vehicle.php">Add New Vehicle</a> -->
</div>

</body>
</html>
