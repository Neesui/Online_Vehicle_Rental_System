<?php

if (isset($_POST['btnupdate'])) {
    $err = [];
    extract($_POST);

    //check name
    if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])) {
        $name = $_POST['name'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['name'])) {
            $err['name'] = "**Please enter a valid  Name";
        }
    } else {
        $err['name'] = "**Please enter the name";
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


    //check phone number
    if (isset($_POST['phone']) && !empty($_POST['phone']) && trim($_POST['phone'])) {
        $phone = $_POST['phone'];
        if (!preg_match('/^[9]{1}[0-9]{9}$/',$_POST['phone'] )) {
            $err['phone'] = "**Please enter a valid phone number of 10 digits .";
        }
    } else {
        $err['phone'] = "**Please enter the phone number";
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

    if (count($err) == 0) {
        require_once'connection.php';
        $query = "UPDATE customer set fullname = '$name', email = '$email', Address = '$address', Phone_Number = '$phone' where c_id = '$id'";
        if (mysqli_query($connection, $query)) {
            echo '<script>alert("Update Successfully");</script>';
            // header('location: userlogin.php');
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
    $sql = "select * from customer where c_id=$id";
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
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title></title>
</head>
<body>
    <div class="update-user-profile-right-product-form_box">
    <form class="update-user-profile-product-form-box" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <h1 class="ubook">Update Booking</h1>
        <div class="user-profile-input-box">
            <label><b>Full Name</b></label>
            <input type="text" placeholder="Enter Full Name" name="name" value="<?php echo $record['full_Name'] ?>">
            <?php if (isset($err['name'])) { ?>
                <span class="error"><?php echo isset($err['name']) ? $err['name'] : ''; ?></span>
            <?php } ?>
        </div>
        <div class="user-profile-input-box">
            <label><b>Address</b></label>
            <input type="text" placeholder="Enter Address" name="address" value="<?php echo $record['Address'] ?>">
            <?php if (isset($err['address'])) { ?>
                <span class="error"><?php echo isset($err['address']) ? $err['address'] : ''; ?></span>
            <?php } ?>
        </div>
        <div class="user-profile-input-box">
            <label><b>Email</b></label>
            <input type="text" placeholder="Enter your Email" name="email" value="<?php echo $record['email'] ?>">
            <?php if (isset($err['email'])) { ?>
                <span class="error"><?php echo isset($err['email']) ? $err['email'] : ''; ?></span>
            <?php } ?>
        </div>
        <div class="user-profile-input-box">
            <label><b>Phone Number</b></label>
            <input type="text" placeholder="Enter Your Phone Number" name="phone" value="<?php echo $record['Phone_Number'] ?>">
            <?php if (isset($err['phone'])) { ?>
                <span class="error"><?php echo isset($err['phone']) ? $err['phone'] : ''; ?></span>
            <?php } ?>
        </div>
        <button type="submit" class="btup" name="btupdate">Update</button>
    </form>
</div>
</body>
</html>


 