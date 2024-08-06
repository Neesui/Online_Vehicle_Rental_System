<?php
if (isset($_COOKIE['uname'])) {
	session_start();
	$_SESSION['uname'] =$_COOKIE['uname'];
	header('location: dashboard.php');
}
$uname = $pass = '';
	if (isset($_POST['btnLogin'])) {
		$err = [];
		extract($_POST);

		//check username
		if (isset($_POST['uname']) && !empty($_POST['uname']) && trim($_POST['uname'])) 
			{
				if (!preg_match('/^[a-zA-Z0-9\s]{5,20}$/', $_POST['uname'])) {
					$err['uname'] = 'Enter Valid Username';
				}
				$uname = $_POST['uname'];
			} else{
				$err['uname'] = 'Enter Username';
			}

		//check password
		if (isset($_POST['pass']) && !empty($_POST['pass']) && trim($_POST['pass'])) {
    		$small = preg_match('/[a-z]/', $_POST['pass']);
   			$captital = preg_match('/[A-Z]/', $_POST['pass']);
    		$number = preg_match('/[0-9]/', $_POST['pass']);
    		$special = preg_match('/[\$\@\#\!\_\-\*]/', $_POST['pass']);
    		$len = strlen($_POST['pass']);
    		if ($small == 1 && $captital == 0 && $number == 1 && $special == 0 && $len >=8 && $len <=  16) {
      			$pass = ($_POST['pass']);
      			$enctypted_pass = md5($pass);
    		} else {
     			$err['pass'] = "Enter valid password";
    		}
  			 }else {
    			$err['pass'] = "Enter password";	
  		}


  		if (count($err) == 0) {
    		$login = false;
      		require_once'connection.php';
      		// query to select data using username and password and status
      		 echo $sql = "select id,name,email from admin where username='$uname' and password='$enctypted_pass' and status=1";
      		//execute query
      		$result = $connection->query($sql);
      		if ($result->num_rows == 1) {
      			$login = true;
       			$row = $result->fetch_assoc();
       		}
       			if ($login) {
       				session_start();
       			$_SESSION['admin_id'] = $row['id'];

       			 if (isset($_POST['remember'])) {
       			 	setcookie('uname', $uname, strtotime('+7days'));
       			 }
       		}
       			
        		

        		header('location:dashboard.php');
			}
		} 
		
 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="dashboard.css">
	<title>Form page</title>
</head>
<body class="admin-background">
	<div class="login-box">
		<h1>Login Page</h1>

	 	<form action="" method="post" class="input-form">
	 			<input type="text" name="uname" id="uname" placeholder="Enter Username" value="<?php echo isset($uname)?$uname:''?>">
	 			<br>
	 			<?php  if (isset($err['uname'])){?>
					<span class="error"><?php echo $err['uname'] ?></span>
				<?php }?>
	 			<input type="password" name="pass" id="pass" placeholder="Enter Password" value="<?php echo isset($pass)?$pass: ''?>">
	 			<br>
	 			<?php  if (isset($err['pass'])){?>
					<span class="error"><?php echo $err['pass'] ?></span>
				<?php }?>

				<br>
				
	    		<input type="checkbox" name="remember" id="remember" value="remember"/><span class="rem">Remember me for 7 days
	    		</span>
	    		
	 		<div>
	 			<button type="submit" name="btnLogin" value="Login">Login</button>
	 		</div>
	 	</form>
	 	<!-- <a href="#" class="forget-pass">Forget Password ?</a> -->
	</div> 	
</body>
</html>