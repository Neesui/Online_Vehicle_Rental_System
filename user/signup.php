<?php
if (isset($_POST['submit'])) {
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

    // Check password
    if (isset($_POST['pass']) && !empty($_POST['pass'])) {
        $pass = $_POST['pass'];
        $len = strlen($pass);
        
        if ($len < 8) {
            $err['pass'] = "Password should be at least 8 characters long";
        } elseif (!preg_match('/[A-Za-z0-9\d@$#!%*?&]{8}/', $pass)) {
            $err['pass'] = "Invalid Password";
        }
    } else {
        $err['pass'] = "Enter a password";
    }

    // Check Confirm password
    if (isset($_POST['cpass']) && !empty($_POST['cpass'])) {
        $cpass = $_POST['cpass'];
        
        if ($cpass !== $pass) {
            $err['cpass'] = "Passwords do not match";
        }
    } else {
        $err['cpass'] = "Please confirm the password";
    }
    

    if (count($err) == 0) {
        require_once'connection.php';
        $query = "INSERT INTO customer ( Full_Name, email, Password, Address, Phone_Number) VALUES ('$name','$email', '$pass', '$address','$phone')";
        if (mysqli_query($connection, $query)) {
            echo '<script>alert("Register Successfully");</script>';
            header('location: userlogin.php');
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
    <title>Sign In Form</title>
    <link rel="stylesheet" type="text/css" href="usersignup.css">
    <style>
        .error{
            color:white;
        }
        </style>
</head>
<body>
        <header class="sighup-head">
            <h1>Welcome to Online <br/>Vehicle Rental Management System</h1>
        </header>
    <div class="signup-box">
        <h2>Sign Up</h2>
        <!-- <p>Please fill in this form to create an account</p> -->
        <form method="POST" class="sighup-form">
            <input type="text" placeholder="Full Name" name="name" value="<?php echo isset($name) ? $name : "" ?>">
            <span class="error"><?php if (isset($err['name'])) { ?>
                <?php echo $err['name'] ?>
            <?php } ?></span>

            <input type="text" placeholder="Email" name="email" id="email" value="<?php echo isset($email) ? $email : "" ?>">
            <span class="error" id="email-error"><?php if (isset($err['email'])) { ?>
                <?php echo $err['email'] ?>
            <?php } ?></span>
            <div id="email-status"></div>

            <input type="text" placeholder="Adddress" name="address" value="<?php echo isset($address) ? $address : "" ?>">
            <span class="error"><?php if (isset($err['address'])) { ?>
                <?php echo $err['address'] ?>
            <?php } ?></span>

            <input type="phone" placeholder=" Phone Number" name="phone" value="<?php echo isset($phone) ? $phone : "" ?>">
           <span class="error"><?php if (isset($err['phone'])) { ?>
                <?php echo $err['phone'] ?>
            <?php } ?></span>

            <input type="password" placeholder="Password" name="pass" value="<?php echo isset($pass) ? $pass : "" ?>">
            <?php if (isset($err['pass'])) { ?>
            <span class="error"><?php echo $err['pass'] ?>
            <?php } ?>

            <input type="password" placeholder="Confirm Password" name="cpass" value="<?php echo isset($cpass) ? $cpass : "" ?>">
            <span class="error"><?php if (isset($err['cpass'])) { ?>
                <?php echo $err['cpass'] ?>
            <?php } ?>

            <button type="submit" name="submit" id="btnsignup">Sign Up</button>
        </form>
        </div>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#email').keyup(function(){
                var email = $(this).val();
                $.ajax({
                    url: 'ajaxemail.php',
                    data: {'checkemail': email},
                    dataType: 'text',
                    method: 'POST',
                    success: function(resp){
                        $('#email-status').html(resp);
                        if (resp === 'Email Available') {
                            $('#email-status').css({color: 'green'});
                        } else {
                            $('#email-status').css({color: 'black'});
                        }
                    }
                });
            });
        });

    </script>
</body>
</html>
 