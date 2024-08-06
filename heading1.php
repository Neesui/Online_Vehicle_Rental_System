<?php
include_once("connection.php");

// Query to fetch categories
$sql = "SELECT * FROM categories";
$result = mysqli_query($connection, $sql);

// Initialize an empty array to store the categories
$categories = [];

// Check if there are any results
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($categories,$row);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="heading2.css">
</head>
<body>
<div class="header">
    <div class="logo">
        <img src="img/car.jpg" id="himg">
        <h2 id="logotext">Online Vehicle<br> Rental</h2>
    </div>
    <div class="mail">
        <i class="fa fa-solid fa-envelope" style="font-size:36px;"></i> 
        <span id="h-mail"><h4>FOR SUPPORT MAIL US:</h4>
        <p>onlinevehicle@gmail.com<p/></span>
    </div>
    <div class="h-contact">
        <i class="fa fa-phone-square" id="hfa" style="font-size:36px"></i>
        <span id="h-con"><h4>SERVICE HELPLINE CALL US: </h4>
        <p>981010102030</p> </span> 
    </div>
    <div class="h-button">
        <button><a href="user/signup.php">Sign Up</a></button>
        <span class="regdropmenu">
            <button><a href="user/userlogin.php">Login</a></button>
            <!-- <ul>
                <li><a href="admin/index.php">Admin</a></li>
                <li><a href="user/index.php">Customer</a></li>
            </ul>   -->  
        </span>
    </div>
</div>

<div class="h-main">
    <div class="h-contents">
        <ul class="nav"> 
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="aboutpage.php">About</a></li>
            <li><a href="Contact.php">Contact</a></li>
            <li><a href="index.php">Service</a>
                <div class="drop-down-menu">
                    <ul>
                        <?php
                        // Loop through the categories and generate menu items
                        foreach ($categories as $category) {
                            echo "<li><a href='service.php?id=$category[category_id]'>".$category['name'] ."</a></li>";
                        }
                        ?>
                    </ul>
                </div>

            </li>

        </ul>
        <!-- <input class="srh" type="text"  placeholder="Search"> -->
    </div>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="heading2.css">
</head>
<body>


<!-- echo '<div class="car-four-box1">';
        echo '<div class="car-four1">';
        echo '<span><img src="admin/uploads/' . $row['image'] . '" ></span>';
        echo '<div class="car-text">';
        echo '<p>' . $carfuel . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>' . $carmodel . '&nbsp;Model</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $carseats . '&nbsp;seats</span></p>';
        echo '</div>';
        echo '<div class="car-describe">';
        echo '<h4 class="honda">' . $carName . '<span class="rate">' . $carPrice . '/Day</span></h4>';
        echo '<div class="car-detail">';
        echo '<p>' . $carDetail . '<br>' . '</p>';
        echo '</div>'; -->