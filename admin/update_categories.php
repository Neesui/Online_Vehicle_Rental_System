<?php
$id = $_GET['category_id'];
session_start();
	if (isset($_POST['btnCategory'])) {
    $err = [];

    //check Category name
    if (isset($_POST['Category_name']) && !empty($_POST['Category_name']) && trim($_POST['Category_name'])) {
        $Category_name = $_POST['Category_name'];
        if (!preg_match('/^[A-Za-z\s]+$/', $_POST['Category_name'])) {
            $err['Category_name'] = "**Please enter a valid Category Name";
        }
    } else {
        $err['Category_name'] = "**Please enter the Category Name";
    }

    //check Rank 
    if (isset($_POST['rank']) && !empty($_POST['rank']) && trim($_POST['rank'])) {
        $rank = $_POST['rank'];
        if (!preg_match('/^[0-9]{1,3}$/',$_POST['rank'] )) {
            $err['rank'] = "**Please enter a valid rank ";
        }
    } else {
        $err['rank'] = "**Please enter the rank";
    }

    //check Status
    $status = $_POST['status'];

    if (count($err) == 0) {
      require_once'connection.php';
      $updated_at = date('Y-m-d H:i:s');
      $updated_by = $_SESSION['admin_id'];
        $query = "UPDATE categories set name = '$Category_name', rank = '$rank', status = '$status' where category_id=$id";
        if (mysqli_query($connection, $query)) {
            echo '<script>alert("Category Update Successfully");</script>';
            header("location:list_categories.php");
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
    $sql = "select * from categories where category_id=$id";
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
	<link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="dashboard.css">
	<title>Update Categories</title>
</head>
<body>
	<?php
		include_once('maindashboard.php')
	?>
	<form class="Category-form-box"action="<?php echo $_SERVER['PHP_SELF']?>?category_id=<?php echo $id ?>" method="post">
		<h2>Update Categories</h2>
		<div class="Category-box">
            <label>Name</label>
            <input type="text" name="Category_name" placeholder="Enter Category Name" value="<?php echo $record['name']?>">
           <?php  if (isset($err['Category_name'])){?>
            <span class="error"><?php echo $err['Category_name'] ?></span>
            <?php }?>
        </div>
        <div class="Category-box">
            <label>Rank</label>
            <input type="number" name="rank" placeholder="Enter rank" value="<?php echo $record['rank']?>">
            <?php  if (isset($err['rank'])){?>
            <span class="error"><?php echo $err['rank'] ?></span>
            <?php }?>
        </div>
        <div class="Category-box">
            <label>Status</label>
            <?php if ($record['status'] == 1)  { ?>
                <input type="radio" name="status" value="1" checked="">Active
                <input type="radio" name="status" value="0">In-active
            <?php } else { ?>
                <input type="radio" name="status" value="1">Active
                <input type="radio" name="status" value="0" checked="">In-active
                <?php }?>
        </div>
		<button type="submit" class="btnAdd" name="btnCategory">Update Category</button>
	</form>
</body>
</html>