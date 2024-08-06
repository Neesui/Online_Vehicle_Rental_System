<?php 
session_start();
// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit;
}

// Check the connection
$conn = mysqli_connect('localhost', 'root', '', 'online_vehicle_rental');

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch and display the booking data for the logged-in user
$c_id = $_SESSION['c_id'];

// $sql = "SELECT * FROM booking "; // Modify the query to filter by user 
$sql = "SELECT booking.b_id, booking.Full_Name, booking.Email, booking.End_Date, booking.Booking_Date, booking.status , vehicle.Vehicle_name, booking.Vehicle_Category FROM booking join vehicle on vehicle.vehicle_id = booking.vehicle_id WHERE c_id = '$c_id';
";
// Modify the query to filter by user ID

$res = mysqli_query($conn, $sql);
$data = [];

if ($res->num_rows > 0) {
    while ($r = mysqli_fetch_assoc($res)) {
        array_push($data, $r);
    }
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
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <?php 

    include_once('user-main-dashboard.php'); ?>

    <?php
    $status_classes = [
        0 => 'un-success', // Pending
        1 => 'success',   // Approved
        2 => 'cancle',  // Cancle
        3 => 'return' // Return
    ];
    ?>

    <div class="list">
        <h1 class="aaa">List of Booking</h1>
        <table class="tablestyle">
            <tr>
                <th>SN</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Vehicle Type</th>
                <th>Vehicle Name</th>
                <th>Booking Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($data as $booked) { ?>
                <tr>
                    <td><?php echo $booked['b_id'] ?></td>
                    <td><?php echo $booked['Full_Name'] ?></td>
                    <td><?php echo $booked['Email'] ?></td>
                    <td><?php echo $booked['Vehicle_Category'] ?></td>
                    <td><?php echo $booked['Vehicle_name'] ?></td>
                    <td><?php echo $booked['Booking_Date'] ?></td>
                    <td><?php echo $booked['End_Date'] ?></td>
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
                    <td class="actioncol">
                        <a href="user_update_booking.php?b_id=<?php echo $booked['b_id'] ?>" class="edit">Update</a>
                       
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>