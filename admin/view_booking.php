<?php

if (isset($_GET['b_id'])) {
    $id = $_GET['b_id'];

    if (!is_numeric($id)) {
        header("Location: list_booking.php");
        exit;
    }

    require_once "connection.php";
    // Query to select data from table
    $sql = "SELECT booking.b_id, booking.Full_Name, booking.Email, booking.Phone_Number,booking.Address, booking.Rent_Days, booking.Vehicle_Category, booking.Booking_Date, booking.End_Date, booking.Driving_License, booking.Message, booking.status, booking.message,vehicle.Vehicle_name 
        FROM booking
        JOIN vehicle on vehicle.vehicle_id = booking.vehicle_id
        WHERE b_id = $id";

    // Execute query
    $result = $connection->query($sql);

    // Check if query execution was successful
    if ($result) {
        // Check number of rows fetched by query
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        } else {
            $row = []; // Assign an empty array when no rows are fetched
        }
    } else {
        // Handle query execution error
        echo "Query error: " . $connection->error;
        exit;
    }
} else {
    $row = []; // Assign an empty array when 'id' parameter is not set
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <title>View Booking</title>
</head>
<body>
    <?php
        include_once'maindashboard.php';
    ?>

    <div class="booking-list">
        <h2 class="booking-h1list">Booking</h2>
        <table class="booking-tablestyle" border="1px solid black">
                <?php if (!empty($row)) { ?>
                    <tr>
                        <th>S.N</th>
                        <td><?php echo $row['b_id'];?></td>
                    </tr>    
                    <tr>
                        <th>Name</th>
                        <td><?php echo $row['Full_Name'];?> </td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo $row['Phone_Number'];?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $row['Email'];?></td>
                    </tr> 
                    <tr>   
                        <th>Address</th>
                        <td><?php echo $row['Address'];?></td>
                    </tr>
                    <tr>    
                        <th>Vehicle Category</th>
                        <td><?php echo $row['Vehicle_Category'];?></td>
                    </tr>    
                    <tr>
                        <th>Vehicle Name</th>
                        <td><?php echo $row['Vehicle_name'];?></td>
                    </tr>    
                    <tr>
                        <th>Booking Date</th>
                        <td><?php echo $row['Booking_Date'];?></td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td><?php echo $row['End_Date'];?></td>
                    </tr>
                    <tr>    
                        <th>Rent Day</th>
                        <td><?php echo $row['Rent_Days'];?></td>
                    </tr> 
                    <tr>   
                        <th>Driving_License</th>
                        <td><img src="uploads/<?php echo $row['Driving_License'] ?>" width="30%"></td>
                    </tr>
                    <!-- <tr>  
                        <th>Status</th> 
                        <td><?php if($row['status'] == 2) { ?>
                        <span class="success">Cancel</span>
                        <?php } else {?>
                        <span class="un-success"></span></td>
                        <?php } ?>
                    </tr>  -->
                    <tr>  
                        <th>Message</th> 
                        <td><?php echo $row['Message'];?></td>
                    </tr>   
            <?php }?>                    
        </table>
    </div>
</body>
</html>
