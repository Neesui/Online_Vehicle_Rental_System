<?php

if (isset($_GET['vehicle_id'])) {
    $id = $_GET['vehicle_id'];

    if (!is_numeric($id)) {
        header("Location: add_vehicle.php");
        exit;
    }

    require_once "connection.php";
    // Query to select data from table
    $sql = "SELECT * FROM vehicle WHERE vehicle_id = $id";

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
    <title>View Vehicle</title>
</head>
<body>
    <?php
        include_once('maindashboard.php');

    ?>

  <div class="vehicle-view">
    <h2 class="vehicle-view-h2">Vehicle Details</h2>
    <?php if (!empty($row)) { ?>
        <table class="vehicle-view-table" border="1px solid black">
            <tr>
                <th>SN</th>
                <td><?php echo $row['vehicle_id'] ?></td>
            </tr> 
            <tr>
                <th>Vehicle Name</th>
                <td><?php echo $row['Vehicle_name'] ?></td>
            </tr>    
            <tr>
                <th>Vehicle Model</th>
                <td><?php echo $row['model'] ?></td>
            </tr>    
            <tr>
                <th>Vehicle Fuel</th>
                <td><?php echo $row['fuel'] ?></td>
            </tr>    
            <tr>
                <th>Vehicle Seats</th>
                <td><?php echo $row['seats'] ?></td>
            </tr>    
            <tr>
                <th>Vehicle Price</th>
                <td><?php echo $row['price'] ?></td>
            </tr>    
            <tr>
                <th>Vehicle Images</th>
                <td><img src="uploads/<?php echo $row['image'] ?>" width="30%"></td>
            </tr>    
            <tr>
                <th>Vehicle Message</th>
                <td><?php echo $row['message'] ?></td>
            </tr>    
            <tr>
                <th>created_by</th>
                <td><?php echo $row['created_by'] ?></td>
            </tr>    
            <tr>
                <th>created_at</th>
                <td><?php echo $row['created_at'] ?></td>
            </tr>    
            <tr>
                <th>updated_by</th>
                <td><?php echo $row['updated_by'] ?></td>
            </tr>    
            <tr>
                <th>updated_at</th>
                <td><?php echo $row['updated_at'] ?></td>
            </tr>    
            <!-- <tr>
                <th>status</th>
                <td><?php echo $row['status'] ?></td>
            </tr>   -->  
                <?php }?>
        </table>
</div>

</body>
</html>
