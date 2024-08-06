  <?php
 session_start();
 if (!isset($_SESSION['Email'])) {
  // header('location: user/userlogin.php' );
}
 if (isset($_GET['vehicle_id'])) {
        $vehicle_id = $_GET['vehicle_id'];
}

if (isset($_POST['submit'])) {
    $photo =$vehicle_id= $c_id='';
    $img= '';
    $err = [];

   $vehicle_id = $_GET['vehicle_id'];

     if (isset($_SESSION['c_id'])) {
    // Display customer details if a c_id is provided in the URL
         $c_id = $_SESSION['c_id'];
     }
     
    //check name
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
            $err['phone'] = "**Please enter a valid phone number of 10 digits .";
        }
    } else {
        $err['phone'] = "**Please enter the phone number";
    }

    //check Rent Days
    if (isset($_POST['rent']) && !empty($_POST['rent']) && trim($_POST['rent'])) {
        $rent = $_POST['rent'];
        if (!preg_match('/^[0-9]{1}$/',$_POST['rent'] )) {
            $err['rent'] = "**vehicle rent is avilable for 1 to 9 days only.";
        }
    } else {
        $err['rent'] = "**Please enter the rent days";
    }

    //check Address
    if (isset($_POST['address']) && !empty($_POST['address']) && trim($_POST['address'])) {
        $address = $_POST['address'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['address'])) {
            $err['address'] = "**Please enter a valid address";
        }
    } else {
        $err['address'] = "**Please enter the address";
    }

    //check Vehicle Category
    if (isset($_POST['vcategory']) && !empty($_POST['vcategory']) && trim($_POST['vcategory'])) {
        $vcategory = $_POST['vcategory'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['vcategory'])) {
            $err['vcategory'] = "**Please enter a valid  Vehicle Type";
        }
    } else {
        $err['vcategory'] = "Please enter the Vehicle Type";
    }

    
    // // check Driving License Image validation
    if ($_FILES['photo']['error'] == 0) {
    if ($_FILES['photo']['size'] <= 5000000) {
      $imFormat = ['image/png','image/jpeg'];
      if (in_array($_FILES['photo']['type'], $imFormat)) {
        $fname = uniqid() . '_' . $_FILES['photo']['name'];
      move_uploaded_file($_FILES['photo']['tmp_name'],'admin/uploads/' . $fname );
      } else {
        $err['photo'] = 'Select Valid Image Format(PNG,JPEG)';
      }
        } else {
        $err['photo'] = 'Select Valid Image Size (less than 5MB)';
       }
     } else{
        $err['photo'] = 'Select Image';
     }



     // Get the current date
    $currentDate = date('Y-m-d');

    // Validate booking date
    if (isset($_POST['start']) && !empty($_POST['start']) && trim($_POST['start'])) {
        $start = $_POST['start'];
        $end = $_POST['end'];
        $sd = strtotime($start);
        $ed = strtotime($end);
        $cd = strtotime($currentDate);

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $start)) {
            $err['start'] = "Enter valid date in the format of YYYY-MM-DD";
        } else {
            if ($sd < $cd) {
                $err['start'] = "Booking date must not be in the past";
            } 
            elseif ($cd > $ed) {
                $err['start'] = "Booking date must be before the end date";
            }
        }
    } else {
        $err['start'] = "Please enter the date";
    }

// Validate end date
    if (isset($_POST['end']) && !empty($_POST['end']) && trim($_POST['end'])) {
        $end = $_POST['end'];
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['end'])) {
            $err['end'] = "Enter valid date in the format of YYYY-MM-DD";
        }
    } else {
        $err['end'] = "Please enter the end date";
    }
       
    //check vehicle message
    if (isset($_POST['msg']) && !empty($_POST['msg']) && trim($_POST['msg'])) {
         $msg = $_POST['msg'];
       
    } else {
        $err['msg'] = "**Please enter the Message";
    }

    if (count($err) == 0) {
      require_once('connection.php');
      $query = "INSERT INTO booking (Full_name, Email, Phone_Number, Address, Vehicle_Category, Driving_License, Booking_Date, End_Date, Rent_days, Message, vehicle_id, c_id)  VALUES ('$name', '$email','$phone', '$address', '$vcategory','$fname', '$start', '$end','$rent', '$msg' ,'$vehicle_id', '$c_id')";
        if (mysqli_query($connection, $query)) {
            echo '<script>alert("Booking Successfully");</script>';
            header("location:index.php");    
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($connection);
        }

        mysqli_close($connection);
        }
    }
?>

<?php 


 if (isset($_GET['vehicle_id'])) {
        $vehicle_id = $_GET['vehicle_id'];
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="heading2.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Product</title>
    <style type="text/css">
        .error{
            color: red;
            font-size: 15px;
        }
    </style>
</head>
<body>

    
        <h1 class="h1book">Booking Form</h1>
            <form class="product-form-box"action="<?php echo $_SERVER['PHP_SELF']?>?vehicle_id=<?php echo $vehicle_id ?>" method="post" enctype="multipart/form-data">
                <fieldset class="boder">
                <div class="input-box"> 
                    <label><b>Full Name</b></label>
                    <input type="text" placeholder="Enter Your Name" name="name" value="<?php echo isset($name) ? $name : '';  ?>">
                    <?php  if (isset($err['name'])){?>
                    <span class="error"><?php echo isset($err['name']) ? $err['name'] : ''; ?></span>
                    <?php }?>
                </div>  
                <div class="input-box"> 
                    <label><b>Email</b></label>
                    <input type="email" placeholder="Enter Email" name="email" value="<?php echo isset($email) ? $email : '';  ?>">
                    <?php  if (isset($err['email'])){?>
                    <span class="error"><?php echo isset($err['email']) ? $err['email'] : ''; ?></span>
                    <?php }?>
                </div>  
                <div class="input-box"> 
                    <label><b>Phone Number</b></label>
                    <input type="phone" placeholder="Enter Phone Number" name="phone" value="<?php echo isset($phone) ? $phone : '';  ?>">
                    <?php  if (isset($err['phone'])){?>
                     <span class="error"><?php echo isset($err['phone']) ? $err['phone'] : ''; ?></span>
                     <?php }?>
                </div>
                 <div class="input-box">
                    <label><b>Address</b></label>
                    <input type="text" placeholder="Enter Address " name="address" value="<?php echo isset($address) ? $address : '';  ?>" >
                    <?php  if (isset($err['address'])){?>
                    <span class="error"><?php echo isset($err['address']) ? $err['address'] : ''; ?></span>
                    <?php }?>
                </div>   
                <div class="destination">
                    <div class="de">
                        <div class="input-box"> 
                        <label><b>Rent Days</b></label>
                        <input type="number" placeholder="Enter Rent Days" name="rent" value="<?php echo isset($rent) ? $rent : '';  ?>">
                        <?php  if (isset($err['rent'])){?>
                        <span class="error"><?php echo isset($err['rent']) ? $err['rent'] : ''; ?></span>
                        <?php }?>
                    </div>  
                        <div class="input-box">
                            <label><b>Booking Date</b></label>
                            <input type="text" placeholder="Enter Start Date" name="start" value="<?php echo isset($start) ? $start : '';  ?>">
                            <?php  if (isset($err['start'])){?>
                            <span class="error"><?php echo isset($err['start']) ? $err['start'] : ''; ?></span>
                            <?php }?>
                        </div>
                    </div>  
                    <div class="des">
                    <div class="input-box">
                        <label><b>Vehicle Type</b></label>
                        <input type="text" placeholder="Enter Vehicle Category" name="vcategory" value="<?php echo isset($vcategory) ? $vcategory : '';  ?>">
                        <?php  if (isset($err['vcategory'])){?>
                        <span class="error"><?php echo isset($err['vcategory']) ? $err['vcategory'] : ''; ?></span>
                        <?php }?>
                    </div>
                    <div class="input-box">
                        <label><b>End Date</b></label>
                        <input type="text" placeholder="Enter End Date" name="end" value="<?php echo isset($end) ? $end : '';  ?>">
                        <?php  if (isset($err['end'])){?>
                        <span class="error"><?php echo isset($err['end']) ? $err['end'] : ''; ?></span>
                        <?php }?>
                    </div>  
                </div>   
                </div>
                <div class="input-box"> 
                    <label><b>Driving License Image</b></label>
                    <input type="file"name="photo"  value="<?php echo isset($fname)?$fname:''?>"/>
                    <?php  if (isset($err['photo'])){?>
                    <span class="error"><?php echo $err['photo'] ?></span>
                    <?php }?>
                </div> 
                <div class="input-box"> 
                    <label><b>Message</b></label>
                    <textarea placeholder="Type Message" name="msg"> <?php echo isset($msg)?$msg:''?></textarea>
                    <?php  if (isset($err['msg'])){?>
                    <span class="error"><?php echo $err['msg'] ?></span>
                    <?php }?>
                </div>
                <button type="submit" class="btnSubmit" name="submit">Submit</button>
                </fieldset>
            </form>
        </div>
    </div>



</body>
</html>
 