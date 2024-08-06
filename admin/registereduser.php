<?php
require_once "connection.php";
//query to select data from table
$sql = "SELECT customer.full_Name, customer.Address, customer.email, customer.Phone_Number FROM customer";
//execute query
$result = $connection->query($sql);
//assign blank array to store data from result
$data = [];
//check number of rows fetch by query
if($result-> num_rows > 0){
    //fetch data from resullt object
    while($row = $result->fetch_assoc()){
        array_push($data,$row);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="dashboard.css">

    <title>View User</title>
    
</head>
<body>
     <?php

    include_once 'maindashboard.php';
?> 
    <!-- <h2 class="viewuser">User / View Users</h2> -->
    
    <h1 class="viewuser1">  Registered User</h1>
    <table class="tablestyle-user">
        <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        <thead>
            
        <tbody>
        <?php if(count($data) > 0){ ?>
                <?php foreach($data as $key=> $value){ ?>

            <tr>
                <td><?php echo $key+1;  ?></td>
                <td><?php echo $value['full_Name'] ?></td>
                <td><?php echo $value['Address'] ?></td>
                <td><?php echo $value['Phone_Number'] ?></td>
                <td><?php echo $value['email'] ?></td>
            </tr>
            <?php } ?>
            <?php } ?>
    </tbody>
    </table>
</body>
</html>