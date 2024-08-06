<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@600&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <title>Update Booking</title>
    <style type="text/css">
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    if (isset($_POST['submit'])) {
        $err = [];

        // Check if the 'b_id' parameter is set and is a valid integer
        if (isset($_GET['b_id']) && filter_var($_GET['b_id'], FILTER_VALIDATE_INT)) {
            $id = $_GET['b_id'];

            // Check Status
            if (isset($_POST['status'])) {
                $status = $_POST['status'];
            } else {
                $err[] = "Status is required.";
            }

            if (empty($err)) {
                require_once 'connection.php';
                $updated_at = date('Y-m-d H:i:s');
                $updated_by = $_SESSION['admin_id'];

                // Use a prepared statement to update the status
                $query = "UPDATE booking SET status = ? WHERE b_id = ?";
                $stmt = mysqli_prepare($connection, $query);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ii", $status, $id);
                    if (mysqli_stmt_execute($stmt)) {
                        echo '<script>alert("Booking Update Successfully");</script>';
                        // header("location:list_booking.php");
                        // Redirect to another page or perform other actions as needed
                    } else {
                        echo "Error updating data: " . mysqli_error($connection);
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error preparing statement: " . mysqli_error($connection);
                }
                mysqli_close($connection);
            }
        } else {
            $err[] = "Invalid booking ID.";
        }
    }
    ?>


    <?php
    include_once "maindashboard.php";


    // Fetch the booking details for the provided ID
    if (isset($_GET['b_id'])) {
        $id = $_GET['b_id'];
        // Retrieve the booking data and populate the form
        try {
            $connection = mysqli_connect('localhost', 'root', '', 'online_vehicle_rental');
            $sql = "SELECT * FROM booking WHERE b_id = $id";
            $res = mysqli_query($connection, $sql);
            if ($res->num_rows > 0) {
                $record = mysqli_fetch_assoc($res);
                extract($record);
            } else {
                echo "<p>Booking not found.</p>";
                // You can redirect the user or take other actions as needed
            }
        } catch (Exception $e) {
            die('Connection Error: ' . $e->getMessage());
        }
    }
    ?>
    <h1 class="">Update Booking</h1>
    <div class="right-product-form_box">
        <form class="product-form-box" action="<?php echo $_SERVER['PHP_SELF'] ?>?b_id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <div class="input-box">
                <label><b>Booking Status</b></label>
                <?php if (isset($record['status']) && $record['status'] == 1) { ?>
                    <input type="radio" name="status" value="3">Return
                    <input type="radio" name="status" value='1' checked>Approved
                    <input type="radio" name="status" value='0'>Pending
                <?php } elseif (isset($record['status']) && $record['status'] == 3) { ?>
                    <input type="radio" name="status" value="3" checked>Return
                    <input type="radio" name="status" value='1'>Approved
                    <input type="radio" name="status" value='0'>Pending
                <?php } else { ?>
                    <input type="radio" name="status" value="3">Return
                    <input type="radio" name="status" value='1'>Approved
                    <input type="radio" name="status" value='0' checked>Pending
                <?php } ?>
            </div>
            <button type="submit" class="btnSubmit" name="submit">Approve</button>
        </form>
    </div>
</body>
</html>
