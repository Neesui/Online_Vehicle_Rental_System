<?php
$id = $_GET['b_id'];
session_start();
if (isset($_POST['submit'])) {
    extract($_POST);
    $err = [];

    //check Address
    if (isset($_POST['address']) && !empty($_POST['address']) && trim($_POST['address'])) {
        $address = $_POST['address'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['address'])) {
            $err['address'] = "**Please enter a valid address";
        }
    } else {
        $err['address'] = "**Please enter the address";
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

    //check Vehicle Category
    if (isset($_POST['vcategory']) && !empty($_POST['vcategory']) && trim($_POST['vcategory'])) {
        $vcategory = $_POST['vcategory'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['vcategory'])) {
            $err['vcategory'] = "**Please enter a valid  Vehicle Category";
        }
    } else {
        $err['vcategory'] = "Please enter the Vehicle Category";
    }

    


    //check status
    $status = $_POST['status'];

    if (count($err) == 0) {
      require_once'connection.php';
      $updated_at = date('Y-m-d H:i:s');
      // $updated_by = $_SESSION['_id'];
      $query = "UPDATE booking SET Address='$address', Vehicle_Category ='$vcategory',Rent_days = '$rent', status = 2 where b_id= '$id'";
        if (mysqli_query($connection, $query)) {
            echo '<script>alert("Update Successfully");</script>';
           header("location:user_view_booking.php");
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
  include_once"user-main-dashboard.php";

  ?>
        <div class="update-user-right-product-form_box">
            <form class="update-user-product-form-box"action="<?php echo $_SERVER['PHP_SELF']?>?b_id=<?php echo $id ?>" method="post">
                <h1 class="ubook">Update Booking</h1>
                <div class="user-input-box">
                    <label><b>Address</b></label>
                    <input type="text" placeholder="Enter Address " name="address" value="<?php echo $record['Address']?>" >
                    <?php  if (isset($err['address'])){?>
                    <span class="error"><?php echo isset($err['address']) ? $err['address'] : ''; ?></span>
                    <?php }?>
                </div> 
                <div class="user-input-box"> 
                    <label><b>Rent Days</b></label>
                    <input type="number" placeholder="Enter Rent Days" name="rent" value="<?php echo $record['Rent_Days']  ?>">
                     <span class="error"><?php echo isset($err['rent']) ? $err['rent'] : ''; ?></span>
                </div> 
                <div class="user-input-box">
                    <label><b>Vehicle Type</b></label>
                    <input type="text" placeholder="Enter Vehicle Category" name="vcategory" value="<?php echo $record['Vehicle_Category']?>">
                    <?php  if (isset($err['vcategory'])){?>
                    <span class="error"><?php echo isset($err['vcategory']) ? $err['vcategory'] : ''; ?></span>
                    <?php }?>
                </div>    
                <div class="user-input-box">
                    <label><b>Booking Date</b></label>
                    <input type="date" placeholder="Enter Start Date" name="start" value="<?php echo $record['Booking_Date']  ?>">
                    <?php  if (isset($err['start'])){?>
                    <span class="error"><?php echo isset($err['start']) ? $err['start'] : ''; ?></span>
                    <?php }?>
                </div>                
                <div class="user-input-box">
                    <label><b>Status</b></label>
                    <input type="radio" name="status" class="updatesta" value='2'>Cancel
                </div>
                <button type="submit" class="btnSubmit" name="submit">Update</button>
            </form>
        </div>
</body>
</html>       