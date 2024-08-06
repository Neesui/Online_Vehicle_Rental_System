<?php 
//mysqli function, mysqli class, PDO (PHP Data Object)
error_reporting(E_ERROR);
try{
	$connection = mysqli_connect('localhost','root','','online_vehicle_rental');
	$sql = "SELECT * FROM booking WHERE status IN (0, 1,2,3)";
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
	<title>List of Booking</title>
	<link rel="stylesheet" type="text/css" href="dashboard.css">
</head>
<body>
	<?php 

	include_once('maindashboard.php'); ?>

	<div class="list">
		<h1 class="h1list">List of Booking</h1>
		<div></div>
		<table class="tablestyle">
			<tr>
				<th>SN</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
	<?php
    
    // Define a mapping for status values to their corresponding CSS classes
    $status_classes = [
        0 => 'un-success', // Pending
        1 => 'success',   // Approved
        2 => 'cancle',  // Cancle
        3 => 'return' // Return
    ];
    ?>
			<?php foreach ($data as $booked) { ?>
				<tr>
					<td><?php echo $booked['b_id'] ?></td>
					<td><?php echo $booked['Full_Name'] ?></td>
					<td><?php echo $booked['Email'] ?></td>
					<td><?php echo $booked['Phone_Number'] ?></td>
					<td><?php
                            switch ($booked['status']) {
                                case 0:
                                    echo 'Pending';
                                    break;
                                case 1:
                                    echo 'Approved';
                                    break;
                                case 2:
                                    echo 'Cancel';
                                    break;
                                case 3:
                                    echo 'Return';
                                    break;
                                default:
                                    echo 'Unknown';
                            }
                            ?>
                        </td>
                        </span>
                    </td>
                    <td class="actioncol">
                        <a href="view_booking.php?b_id=<?php echo $booked['b_id'] ?>" class="view">View</a>
                        <a href="update_Booking.php?b_id=<?php echo $booked['b_id'] ?>" class="edit">Update</a>
                    </td>
                </tr>  
			<?php } ?>
		</table>
	</div>
</body>
</html>