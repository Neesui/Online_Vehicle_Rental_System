<?php
session_start();
date_default_timezone_set('ASIA/Kathmandu');
    if (isset($_POST['btnCategory'])) {
        extract($_POST);
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
        if (!preg_match('/^[0-9]{1}$/',$_POST['rank'] )) {
            $err['rank'] = "**Please select a valid rank ";
        }
    } else {
        $err['rank'] = "**Please select the rank";
    }

    //check Status
     $status = $_POST['status'];


    // print_r($err);

    if (count($err) == 0) {
       //  database connection 
      include_once('connection.php');
      $created_at = date('Y-m-d H:i:s');
      $created_by = $_SESSION['admin_id'];
      //query to insert data
      $query = "INSERT INTO categories( name, rank, status) VALUES ('$Category_name','$rank','$status')";
        if (mysqli_query($connection, $query)) {
           echo '<script>alert("Category Added Successfully");</script>';
           header("location: list_categories.php");
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
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <title>Add Categories</title>
</head>
<body>
    <?php
        include_once('maindashboard.php');
    ?>
    <form class="Category-form-box"action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <h2>Add Categories</h2>
            <div class="Category-box">
                <label>Name</label>
                <input type="text" name="Category_name" placeholder="Enter Category Name" value="<?php echo isset($Category_name)?$Category_name:''?>">
                <?php  if (isset($err['Category_name'])){?>
              <span class="error"><?php echo $err['Category_name'] ?></span>
              <?php }?>
            </div>
            <div class="Category-box">
            <label>Rank</label>
            <br>
                <select name="rank">
                    <option value="">Select rank</option>
                        <?php 
                        for ($i = 1; $i <= 10; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>   
                </select>   
        </div>
            <div class="Category-box">
                <label>Status</label>
                <input type="radio" name="status" value="1">Active
                <input type="radio" name="status" value="0" checked>In-Active
                <!-- <?php  if (isset($err['status'])){?>
                <span class="error"><?php echo $err['status'] ?></span>
                <?php }?> -->
            </div>
            <button type="submit" class="btnAdd" name="btnCategory" onbtnCategory="return alert('Category Added Succesfully')">Add Category</button>
    </form>
    <!-- <script>
    // Set a timeout to reload the page after the page has loaded (e.g., 3000 milliseconds = 3 seconds)
    window.onload = function() {
        setTimeout(function() {
            location.reload();
        }, 10000); // Adjust the time as needed
    };
</script> -->
</body>
</html>