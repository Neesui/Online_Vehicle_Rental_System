<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@600&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:ital,wght@1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title></title>
</head>
<body>

</body>
</html>
<?php 
//mysqli function, mysqli class, PDO (PHP Data Object)
session_start();
error_reporting(E_ERROR);
try{
    $connection = mysqli_connect('localhost','root','','online_vehicle_rental');
    $sql = "select * from vehicle" ;
    $res = mysqli_query($connection,$sql);
    if ($res->num_rows > 0) {
        $record = mysqli_fetch_assoc($res);
        extract($record);
    } 
    
}catch(Exception $e){
    die('Connection Error: ' . $e->getMessage());
}
 ?>

<?php
include_once("heading1.php");
include_once('connection.php');

if (isset($_GET['id'])) {
    // Display vehicle details if a vehicle_id is provided in the URL
    $category_id = $_GET['id'];

    $query = "SELECT * FROM vehicle WHERE category_id = '$category_id'";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {

        $vName = $row['Vehicle_name'];
        $vId = $row['vehicle_id'];
        $vStatus = $row['status'];
        $vfuel = $row['fuel'];
        $vmodel = $row['model'];
        $vseats = $row['seats'];
        $vPrice = $row['price'];
        $vDetail = $row['message'];

        echo '<div class="car-four-box1">';
                echo '<div class="car-four1">';
                    echo '<span><img src="admin/uploads/' . $row['image'] . '" ></span>';

                    echo '<div class="car-text">';
                        echo '<p>' . $vfuel . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>' . $vmodel . '&nbsp;Model</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $vseats . '&nbsp;Seats</span></p>';
                    echo '</div>';
                    echo '<div class="car-describe">';
                        echo '<h4 class="honda">' . $vName . '<span class="rate">' . $vPrice . '/Day</span></h4>';
                        echo '<div class="car-detail">';
                            echo '<p>' . $vDetail .'<br>' . '</p>';
                        echo '</div>';
                        echo '<div class="sub">';
                        if (!isset($_SESSION['c_id'])) {
                            echo'<input type="submit" class="log1" value="Please Login"></a>';
                        } elseif ($vStatus == 0 ) {
                            echo '<input type="submit" class="log2" value="Unavailable Now"></a>';
                        }elseif ($vStatus == 1 ) {
                        echo '<a href="product-booking.php?vehicle_id=' . $vId . '" class="car-book"><input type="submit" name="car-book-now" value="Book Now"></a>';
                         }else{
                        echo '<a href="product-booking.php?vehicle_id=' . $vId . '" class="car-book"><input type="submit" name="car-book-now" value="Book Now"></a>';
                        }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    }   

?>

    <?php 
        include_once 'footer.php';
    ?> 

</body>
</html>



 <!-- } elseif ($vStatus == 0 ) {
    //     echo 'Unavailable Now';
    // } elseif ($vStatus == 2 ) {
    //     echo '<a href="product-booking.php?vehicle_id=' . $vId . '" class="car-book"><input type="submit" name="car-book-now" value="Book Now"></a>';
    // } -->