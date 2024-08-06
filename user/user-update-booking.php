<?php
$id = $_GET['b_id'];
session_start();
if (isset($_POST['submit'])) {
    extract($_POST);
    $err = [];

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
            $err['phone'] = "**Please enter a valid phone";
        }
    } else {
        $err['phone'] = "**Please enter the phone";
    }

    //check Rent Days
    if (isset($_POST['rent']) && !empty($_POST['rent']) && trim($_POST['rent'])) {
        $rent = $_POST['rent'];
        if (!preg_match('/^[0-9]{1,9}$/',$_POST['rent'] )) {
            $err['rent'] = "**Please enter a valid rent days";
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
            $err['vcategory'] = "**Please enter a valid  Vehicle Category";
        }
    } else {
        $err['vcategory'] = "Please enter the Vehicle Category";
    }

    
    // // check image validation
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

     //check img
     if ($_FILES['img']['error'] == 0) {
    if ($_FILES['img']['size'] <= 5000000) {
      $imFormat = ['image/png','image/jpeg'];
      if (in_array($_FILES['img']['type'], $imFormat)) {
        $iname = uniqid() . '_' . $_FILES['img']['name'];
      move_uploaded_file($_FILES['img']['tmp_name'],'admin/uploads/' . $iname );
      } else {
        $err['img'] = 'Select Valid Image Format(PNG,JPEG)';
      }
        } else {
        $err['img'] = 'Select Valid Image Size (less than 5MB)';
       }
     } else{
        $err['img'] = 'Select Image';
     }


     // Get the current date
    $currentDate = date('Y-m-d');

    // Validate booking date
    if (isset($_POST['start']) && !empty($_POST['start']) && trim($_POST['start'])) {
        $start = $_POST['start'];
        $sd = strtotime($start);
        // $ed = strtotime($end);
        $cd = strtotime($currentDate);

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $start)) {
            $err['start'] = "Enter valid date in the format of YYYY-MM-DD";
        } else {
            if ($sd < $cd) {
                $err['start'] = "Booking date must not be in the past";
            } 
            // elseif ($cd > $ed) {
            //     $err['start'] = "Booking date must be before the end date";
            // }
        }
    } else {
        $err['start'] = "Please enter the start date";
    }

       
        //check vehicle message
        if (isset($_POST['msg']) && !empty($_POST['msg']) && trim($_POST['msg'])) {
             $msg = $_POST['msg'];
           
        } else {
            $err['msg'] = "**Please enter the Message";
        }

    // $status = $_POST['status'];

    if (count($err) == 0) {
        $id = $_GET['b_id'];
      require_once'connection.php';
      $updated_at = date('Y-m-d H:i:s');
      $updated_by = $_SESSION['admin_id'];
      $query = "UPDATE booking SET status = 0 where b_id='$id'";
        if (mysqli_query($connection, $query)) {
           // header("location:list_booking.php");
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    }
}

?>


<?php 
//mysqli function, mysqli class, PDO (PHP Data Object)
error_reporting(E_ERROR);
try{
    $connection = mysqli_connect('localhost','root','','online_vehicle_rental');
    $sql = "select * from booking where b_id=$id";
    $res = mysqli_query($connection,$sql);
    if ($res->num_rows > 0) {
        $record = mysqli_fetch_assoc($res);
        // print_r($record);
        // $name = $record['name'];
        extract($record);
    } else {
        // header('location:list_booking.php');

    }
}catch(Exception $e){
    die('Connection Error: ' . $e->getMessage());
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
    <link rel="stylesheet" type="text/css" href="../style.css">
  <title>Update Booking</title>
  <style type="text/css">
    .error{
      color: red;
    }
  </style>
</head>
<body>
  <?php
  include_once"maindashboard.php";

  ?>
  <div class="right-product-form_box">
            <form class="product-form-box"action="<?php echo $_SERVER['PHP_SELF']?>?b_id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                <div class="input-box"> 
                    <label><b>Full Name</b></label>
                    <input type="text" placeholder="Enter Your Name" name="name" value="<?php echo $record['Full_Name']?>">
                    <?php  if (isset($err['name'])){?>
                    <span class="error"><?php echo isset($err['name']) ? $err['name'] : ''; ?></span>
                    <?php }?>
                </div>  
                <div class="input-box"> 
                    <label><b>Email</b></label>
                    <input type="email" placeholder="Enter Email" name="email" value="<?php echo $record['Email']?>">
                    <?php  if (isset($err['email'])){?>
                    <span class="error"><?php echo isset($err['email']) ? $err['email'] : ''; ?></span>
                    <?php }?>
                </div>  
                <div class="input-box"> 
                    <label><b>Phone Number</b></label>
                    <input type="phone" placeholder="Enter Phone Number" name="phone" value="<?php echo $record['Phone_Number']?> ">
                    <?php  if (isset($err['phone'])){?>
                     <span class="error"><?php echo isset($err['phone']) ? $err['phone'] : ''; ?></span>
                     <?php }?>
                </div>
                <div class="input-box"> 
                    <label><b>Rent Days</b></label>
                    <input type="number" placeholder="Enter Rent Days" name="rent" value="<?php echo $record['Rent_Days']?>">
                    <?php  if (isset($err['rent'])){?>
                     <span class="error"><?php echo isset($err['rent']) ? $err['rent'] : ''; ?></span>
                     <?php }?>
                </div> 
                <div class="input-box">
                    <label><b>Address</b></label>
                    <input type="text" placeholder="Enter Address " name="address" value="<?php echo $record['Address']?>" >
                    <?php  if (isset($err['address'])){?>
                    <span class="error"><?php echo isset($err['address']) ? $err['address'] : ''; ?></span>
                    <?php }?>
                </div>  
                <div class="input-box">
                    <label><b>Vehicle Type</b></label>
                    <input type="text" placeholder="Enter Vehicle Category" name="vcategory" value="<?php echo $record['Vehicle_Category']?>">
                    <?php  if (isset($err['vcategory'])){?>
                    <span class="error"><?php echo isset($err['vcategory']) ? $err['vcategory'] : ''; ?></span>
                    <?php }?>
                </div>  
                <div class="input-box">
                            <label><b>Booking Date</b></label>
                            <input type="date" placeholder="Enter Start Date" name="start" value="<?php echo $record['Booking_Date']?>">
                            <?php  if (isset($err['start'])){?>
                            <span class="error"><?php echo isset($err['start']) ? $err['start'] : ''; ?></span>
                            <?php }?>
                        </div>
                <div class="destination">
                    <div class="de">
                        <div class="input-box"> 
                            <label><b>Driving License Image</b></label>
                            <input type="file"name="photo"  value="<?php echo isset($fname)?$fname:''?>"/>
                            <?php  if (isset($err['photo'])){?>
                            <span class="error"><?php echo $err['photo'] ?></span>
                            <?php }?>
                        </div> 
                    </div>
                        <div class="des">
                        <div class="input-box"> 
                            <label><b>Booking Advance Payment Image</b></label>
                            <input type="file"name="img"  value="<?php echo isset($iname)?$iname:''?>"/>
                            <?php  if (isset($err['img'])){?>
                            <span class="error"><?php echo $err['img'] ?></span>
                            <?php }?>
                        </div>  
                        </div>
                </div>
                <!-- <div class="input-box">
                    <label><b>Booking Status</b></label>
                  <?php if ($record['status'] == 1)  { ?>
                    <input type="radio" name="status" value='1' checked>Approved
                    <input type="radio" name="status" value='0'>Pending
                  <?php  } else { ?>
                    <input type="radio" name="status" value='1'>Approved
                    <input type="radio" name="status" value='0' checked>Pending
                  <?php } ?> 
                </div> -->
                <button type="submit" class="btnSubmit" name="submit" onclick="return alert('Update Succesfully')">Approve </button>
            </form>
        </div>
</body>
</html>       