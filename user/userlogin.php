<?php
session_start();

// Check if the user is already logged in, redirect to the dashboard if they are
if (isset($_SESSION['email'])) {
    header("location: user-dashboard.php");
    exit;
}

// Check the connection
$conn = mysqli_connect('localhost', 'root', '', 'online_vehicle_rental');

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $err = [];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    //check email
    if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $err['email'] = "**Please enter the email field";
    }

    //check password
        if (isset($_POST['pass']) && !empty($_POST['pass']) && trim($_POST['pass'])) {
            $small = preg_match('/[a-z]/', $_POST['pass']);
            $captital = preg_match('/[A-Z]/', $_POST['pass']);
            $number = preg_match('/[0-9]/', $_POST['pass']);
            $special = preg_match('/[\$\@\#\!\_\-\*]/', $_POST['pass']);
            $len = strlen($_POST['pass']);
            if ($small == 1 && $captital == 1 && $number == 1 && $special == 1 && $len >=8 && $len <=  16) {
                $pass = ($_POST['pass']);
                $enctypted_pass = md5($pass);
            } else {
                $err['pass'] = "Enter valid password";
            }
             }else {
                $err['pass'] = "Enter password";    
        }

    if (!empty($email) && !empty($password)) {
        $emaildata = "SELECT * FROM customer WHERE email = '$email'";
        $query = $conn->query($emaildata);

        if ($query) {
            $row = mysqli_num_rows($query);

            if ($row) {
                $user_data = mysqli_fetch_assoc($query);
                $_SESSION['email'] = $user_data['email'];
                $_SESSION['c_id'] = $user_data['c_id'];

                if ($password == $user_data['password']) {
                    if (isset($_POST['remember'])) {
                        setcookie('email', $email, strtotime('+7 days'));
                    }
                    header("location: user-dashboard.php"); 
                    exit;
                } else {
                    $err['pass'] =  "**Incorrect password";
                }
            } else {
                $err['email'] =  "**Email does not exist";
            }
        } else {
            echo "Query execution failed: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login form</title>
    <link rel="stylesheet" type="text/css" href="userlogin.css">
    <style>
        .error {
            color: #f10404;
        } 
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Login</h1>
        <form method="POST" class="sighup-form">
            <input type="text" placeholder="Email" id="email" name="email" value="<?php echo isset($email) ? $email : "" ?>">
            <span class="error"><?php if (isset($err['email'])) { echo $err['email']; } ?></span>

            <input type="password" placeholder="Password" id="pass" name="pass" value="<?php echo isset($pass) ? $pass : "" ?>">
            <span class="error"><?php if (isset($err['pass'])) { echo $err['pass']; } ?></span>

            <?php if (isset($_GET['err']) && $_GET['err'] == 1) { ?>
                <p class="error" color="red">Please login to enter!!</p>
            <?php } ?>
        
            <span class="rem">Remember me</span> -->
            <input type="checkbox" name="remember" id="remember" value="remember"/><span class="rem">Remember me</span>
            <button type="submit" value="Login" class="btn" name="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p> 
    </div>
</body>
</html>