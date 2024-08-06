<?php
if (isset($_POST['submitBtn'])) {
    $err = [];

if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])) {
        $name = $_POST['name'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['name'])) {
            $err['name'] = "**Please enter a valid  Name";
        }
    } else {
        $err['name'] = "**Please enter the name";
    }

    //check email
    if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])) {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err['email'] = "**Please enter a valid email";
        }
    } else {
        $err['email'] = "**Please enter the email field";
    }

    //check phone number
    if (isset($_POST['phone']) && !empty($_POST['phone']) && trim($_POST['phone'])) {
        $phone = $_POST['phone'];
        if (!preg_match('/^[9]{1}[0-9]{9}$/',$_POST['phone'] )) {
            $err['phone'] = "**Please enter a valid phone";
        }
    } else {
        $err['phone'] = "**Please enter the phone";
    }

    //check message
    if (isset($_POST['msg']) && !empty($_POST['msg']) && trim($_POST['msg'])) {
         $msg = $_POST['msg'];
       
    } else {
        $err['msg'] = "**Please enter the Message";
    }

//connection with database and insert data into database
    if (count($err) == 0) {
      require_once'connection.php';
        $query = "INSERT INTO contact_info (Fullname, Email, Phone_Number,Message) VALUES ('$name','$email','$phone','$msg')";
        if (mysqli_query($connection, $query)) {
           // header("location:list_contact-info.php");
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    }
}
?>    

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@600&display=swap" rel="stylesheet">	
	<link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="heading2.css">
    <title>Contact</title>
</head>
<body class="contact">
    <?php
        include_once('heading1.php');
    ?>
	<section class="C-img">
    	<p class="C-con">Contact Us</p>
        <a href="homepage.php" class="linkhome1">Home </a><a href="contact.php" class="contactlink"> < Contact</a>
    </section> 
    <div class="mainboxcontact">
        <div class="left-contact_box">
            <h2 class="left-head">Contact Info</h2>
            <p class="chead">Location</p> 
            <div>
	            <i class="fa fa-map-marker" style="color:black; font-size: 27px;" id="cfa"></i>
	            <p id="cp">Bagbazar, Kathmandu</p>
       		</div>
            <p class="chead">Phone Number</p>
            <div>
	            <i class="fa fa-phone-square" id="cfa" style="color:black; font-size: 27px" id="cfa"></i>
	            <p id="cp">9812145637 9845632147</p>
	        </div>
            <p class="chead">Email</p>
            <div>
	            <i class=" fa fa-solid fa-envelope" style="color:black; font-size: 27px" id="cfa"></i>
	            <p id="cp">onlinevehicle123@gmail.com</p>
        	</div>
        </div>
        <div>
            <!-- <h2>Map</h2> -->
            <!-- <iframe src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=bagbazar kathmandu&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" class="map" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
            <img src="img/map.png" class="map">

        </div>
    </div> 

        <?php

            include_once("footer.php");
         ?>
</body>
</html>