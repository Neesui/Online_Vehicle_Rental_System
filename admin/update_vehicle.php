<?php
$id = $_GET['vehicle_id'];
session_start();
$photo= '';
if (isset($_POST['btnUpdate'])) {
    $err = [];

    //check vehicle name
    if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])) {
        $name = $_POST['name'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['name'])) {
            $err['name'] = "**Please enter a valid Vehicle Name";
        }
    } else {
        $err['name'] = "**Please enter the firstname";
    }

    //check vehicle fuel
    if (isset($_POST['fuel']) && !empty($_POST['fuel']) && trim($_POST['fuel'])) {
        $fuel = $_POST['fuel'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['fuel'])) {
            $err['fuel'] = "**Please enter a valid Vehicle fuel";
        }
    } else {
        $err['fuel'] = "**Please enter the vehicle fuel";
    }


    //check vehicle model
    if (isset($_POST['model']) && !empty($_POST['model']) && trim($_POST['model'])) {
        $model = $_POST['model'];
        if (!preg_match('/^[0-9]{4}$/',$_POST['model'] )) {
            $err['model'] = "**Please enter a valid model";
        }
    } else {
        $err['model'] = "**Please enter the model";
    }

    //check vehicle seat
    if (isset($_POST['seat']) && !empty($_POST['seat']) && trim($_POST['seat'])) {
        $seat = $_POST['seat'];
        if (!preg_match('/^[1-5]{1}+$/', $_POST['seat'])) {
            $err['seat'] = "**Please enter a valid seat";
        }
    } else {
        $err['seat'] = "**Please enter the seat";
    }

    //check vehicle price
    if (isset($_POST['price']) && !empty($_POST['price']) && trim($_POST['price'])) {
        if (!preg_match('/^[0-9]{4,6}$/', $_POST['price'])) {
              $err['price'] = "**Please enter a valid price";
        }
         $price = $_POST['price'];
       
    } else {
        $err['price'] = "**Please enter the price field";
    }

    //check vehicle images
    if ($_FILES['photo']['error'] == 0) {
    if ($_FILES['photo']['size'] <= 5000000) {
      $imFormat = ['image/png','image/jpeg'];
      if (in_array($_FILES['photo']['type'], $imFormat)) {
        $fname = uniqid() . '_' . $_FILES['photo']['name'];
      move_uploaded_file($_FILES['photo']['tmp_name'],'uploads/' . $fname );
      // echo 'Upload success';
      } else {
        $err['photo'] = 'Select Valid Image Format(PNG,JPEG)';
      }
        } else {
        $err['photo'] = 'Select Valid Image Size (less than 5MB)';
       }
     } else{
        $err['photo'] = 'Select Valid Image';
     }

    //check vehicle message
    if (isset($_POST['msg']) && !empty($_POST['msg']) && trim($_POST['msg'])) {
         $msg = $_POST['msg'];
       
    } else {
        $err['msg'] = "**Please enter the Message";
    }

    $status = $_POST['status'];


    if (count($err) == 0) {
        //connection database
      require_once'connection.php';

      $updated_at = date('Y-m-d H:i:s');
      $updated_by = $_SESSION['admin_id'];

       echo $query = "UPDATE vehicle SET Vehicle_name='$name', fuel='$fuel', model='$model', seats='$seat', price='$price', image='$fname', status='$status',message='$msg', updated_at='$updated_at',updated_by='$updated_by'where vehicle_id=$id";
        if (mysqli_query($connection, $query)) {
            echo '<script>alert("Vehicle Update Successfully");</script>';
            header("location:list_vehicle.php");
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
    $sql = "select * from vehicle where vehicle_id=$id";
    $res = mysqli_query($connection,$sql);
    if ($res->num_rows > 0) {
        $record = mysqli_fetch_assoc($res);
        // print_r($record);
        // $name = $record['name'];
        extract($record);
    } else {
        // header('location:list_vehicle.php');
        $category =$res->fetch_assoc();
    }
    print_r($category);
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
    <link rel="stylesheet" type="text/css" href="dashboard.css">
  <title>Update Vehiclle</title>
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
  <div class="update-fullform">
    <h2 class="update-heading-title">Update Vehicle Form</h2>
      <form class="update-vehicle"action="<?php echo $_SERVER['PHP_SELF'] ?>?vehicle_id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
        <div class="update-input-box"> 
          <label><b>Vehicle Name</b></label>
          <input type="text" placeholder="Enter Vehicle Name" name="name"   value="<?php echo $record['Vehicle_name']?>">
          <?php  if (isset($err['name'])){?>
          <span class="error"><?php echo $err['name'] ?></span>
        <?php }?>
        </div>  
        <div class="update-input-box"> 
          <label><b> Vehicle Feul</b></label>
          <input type="fuel" placeholder="Enter Fuel" name="fuel"   value="<?php echo $record['fuel']?>"/>
          <?php  if (isset($err['fuel'])){?>
          <span class="error"><?php echo $err['fuel'] ?></span>
        <?php }?>
        </div> 
        <div class="update-input-box"> 
          <label><b>Vehicle Model</b></label>
          <input type="number" placeholder="Enter Model" name="model"   value="<?php echo $record['model']?>"/>
          <?php  if (isset($err['model'])){?>
          <span class="error"><?php echo $err['model'] ?></span>
        <?php }?>
        </div>  
        <div class="update-input-box"> 
          <label><b>Vehicle Seats</b></label>
          <input type="Number" placeholder="Enter How Many Seats" name="seat"   value="<?php echo $record['seats'] ?>"/>
          <?php  if (isset($err['seat'])){?>
          <span class="error"><?php echo $err['seat'] ?></span>
        <?php }?>
        </div>  
        <div class="update-input-box"> 
          <label><b>Vehicle Price</b></label>
          <input type="Number" placeholder="Enter Price" name="price"   value="<?php echo $record['price']?>"/>
          <?php  if (isset($err['price'])){?>
          <span class="error"><?php echo $err['price'] ?></span>
          <?php }?>
        </div> 
        <div class="update-input-box"> 
            <label>Vehicle Image</label>
            <input type="file"name="photo" value="<?php echo $record['image']?>"/>
            <?php  if (isset($err['photo'])){?>
            <span class="error"><?php echo $err['photo'] ?></span>
            <?php }?>
        </div>
        <div class="update-input-box"> 
            <label>Status</label>
            <?php if ($add_vehicle['status'] == 1) {?>
                <input type="radio" name="status" value="1" checked="">Active
                <input type="radio" name="status" value="0">In-active
            <?php } else { ?>
                <input type="radio" name="status" value="1">Active
                <input type="radio" name="status" value="0" checked="">In-active
                <?php }?>
        </div>
        <div class="update-input-box"> 
          <label><b>Vehicle Message</b></label>
            <textarea type="Number" placeholder="Type Message" name="msg" value="<?php echo $record['message']?>"/></textarea>
            <?php  if (isset($err['msg'])){?>
            <span class="error"><?php echo $err['msg'] ?></span>
            <?php }?>
        </div>
          <button type="submit" class="btnUpdate" name="btnUpdate">Update Vehicle</button>
      </form>
  </div>
</body>
</html>       