<?php
session_start();
date_default_timezone_set('ASIA/Kathmandu');
$photo= '';
if (isset($_POST['btnAdd'])) {
    $err = [];

    //check vehicle name
    if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])) {
        $name = $_POST['name'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['name'])) {
            $err['name'] = "**Please enter a valid Vehicle Name";
        }
    } else {
        $err['name'] = "**Please enter the name";
    }

    
    //check category name
     if (isset($_POST['category']) && !empty($_POST['category']) && trim($_POST['category'])) {
        $category = $_POST['category'];
    } else {
        $err['category'] = "**Please enter the name";
    }


    //check vehicle fuel
    if (isset($_POST['fuel']) && !empty($_POST['fuel']) && trim($_POST['fuel'])) {
        $fuel = $_POST['fuel'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['fuel'])) {
            $err['fuel'] = "**Fuel must be Petrol or Disel";
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
            $err['seat'] = "**Seats value must be 1 to 5";
        }
    } else {
        $err['seat'] = "**Please enter the seat";
    }

    //check vehicle price
    if (isset($_POST['price']) && !empty($_POST['price']) && trim($_POST['price'])) {
        if (!preg_match('/^[0-9]{4,5}$/', $_POST['price'])) {
              $err['price'] = "**Please enter a valid price  ";
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
        $err['photo'] = 'Select Valid Image Format (png or jpeg)';
      }
        } else {
        $err['photo'] = 'Select Valid Image Size (less than 5MB)';
       }
     } else{
        $err['photo'] = 'Select Valid Image';
     }

     //status
     $status = $_POST['status'];


    //check vehicle message
    if (isset($_POST['msg']) && !empty($_POST['msg']) && trim($_POST['msg'])) {
         $msg = $_POST['msg'];
       
    } else {
        $err['msg'] = "**Please enter the Message";
    }

// connection to database
    if (count($err) == 0) {
      require_once'connection.php';
      $created_at = date('Y-m-d H:i:s');
      $created_by = $_SESSION['admin_id'];
      // query to insert data
      $query = "INSERT INTO vehicle (category_id,Vehicle_name, fuel, model, seats, price, image,status, message, created_at,created_by) VALUES ($category,'$name','$fuel','$model','$seat', '$price','$fname','$status','$msg','$created_at','$created_by')";
        if (mysqli_query($connection, $query)) {
            echo '<script>alert("Vehicle Added Successfully");</script>';
            header("location:list_vehicle.php");
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    }
}

?>
<?php 
    error_reporting(E_ERROR);
    try{
        require_once('Connection.php');
        $sql = "select * from categories ";
        $res = mysqli_query($connection,$sql);
        $data = [];
        if($res->num_rows > 0){
            while ($r = mysqli_fetch_assoc($res)){
                array_push($data,$r);
        }
            }
    }
    catch(Exception $e){
        die("Connection Error" . $e->getMessage());
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
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@600&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
  <title>Add Vehiclle</title>
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
  <div class="fullform">
    <h2 class="heading-title">Add Vehicle Form</h2>
      <form class="add-vehicle"action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <div class="add-input-box">
            <label>Categories</label>
                <select name="category">
                    <option value="">select category</option>
                    <?php foreach($data as $key => $categories){?>
                        <option value="<?php echo $categories['category_id']?>"><?php echo $categories['name']?></option>
                    <?php } ?>
                </select>   
        </div>
        <div class="add-input-box"> 
          <label><b>Vehicle Name</b></label>
          <input type="text" placeholder="Enter Vehicle Name" name="name"  placeholder="Enter Vehicle Name" value="<?php echo isset($name)?$name:''?>">
          <?php  if (isset($err['name'])){?>
          <span class="error"><?php echo $err['name'] ?></span>
          <?php }?>
        </div>  
        <div class="add-input-box"> 
          <label><b> Vehicle Fuel</b></label>
          <input type="fuel" placeholder="Enter fuel" name="fuel"  placeholder="Enter Vehicle fuel" value="<?php echo isset($fuel)?$fuel:''?>"/>
          <?php  if (isset($err['fuel'])){?>
          <span class="error"><?php echo $err['fuel'] ?></span>
        <?php }?>
        </div> 
        <div class="add-input-box"> 
          <label><b>Vehicle Model</b></label>
          <input type="number" placeholder="Enter Model" name="model"  placeholder="Enter Vehicle Model" value="<?php echo isset($model)?$model:''?>"/>
          <?php  if (isset($err['model'])){?>
          <span class="error"><?php echo $err['model'] ?></span>
        <?php }?>
        </div>  
        <div class="add-input-box"> 
          <label><b>Vehicle Seats</b></label>
          <input type="Number" placeholder="Enter How Many Seats" name="seat" placeholder="Enter Vehicle Seats"  value="<?php echo isset($seat)?$seat:''?>"/>
          <?php  if (isset($err['seat'])){?>
          <span class="error"><?php echo $err['seat'] ?></span>
        <?php }?>
        </div>  
        <div class="add-input-box"> 
          <label><b>Vehicle Price</b></label>
          <input type="Number" placeholder="Enter Price" name="price"  placeholder="Enter Vehicle Price" value="<?php echo isset($price)?$price:''?>"/>
          <?php  if (isset($err['price'])){?>
          <span class="error"><?php echo $err['price'] ?></span>
          <?php }?>
        </div>
        <div class="add-input-box"> 
            <label>Vehicle Image</label>
            <input type="file"name="photo"  value="<?php echo isset($fname)?$fname:''?>"/>
            <?php  if (isset($err['photo'])){?>
            <span class="error"><?php echo $err['photo'] ?></span>
            <?php }?>
        </div> 
        <div class="add-input-box"> 
            <label>Status</label>
                <input type="radio" name="status" value="1">Active
                <input type="radio" name="status" value="0" checked= ''>In-active
                <!-- <?php  if (isset($err['drive'])){?>
                <span class="error"><?php echo $err['status'] ?></span>
                <?php }?> -->
        </div>
        <div class="add-input-box"> 
          <label><b>Vehicle Message</b></label>
            <textarea type="text" placeholder="Type Message" placeholder="Enter Vehicle Message" name="msg" value="<?php echo isset($msg)?$msg:''?>"/></textarea>
            <?php  if (isset($err['msg'])){?>
            <span class="error"><?php echo $err['msg'] ?></span>
            <?php }?>
        </div>
          <button type="submit" class="btnAdd" name="btnAdd">Add Vehicle</button>
      </form>
  </div>
</body>
</html>       