 <?php
error_reporting(E_ERROR);

include_once "connection.php";
$sql = "SELECT * FROM categories";
$res = mysqli_query($connection, $sql);
$data = [];

if ($res->num_rows > 0) {
    while ($r = mysqli_fetch_assoc($res)) {
        array_push($data, $r);
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
    <title>List of Vehicle</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
</head>

<body>
    <?php
    include_once('maindashboard.php');
    ?>
    <div class="list">
        <h1 class="h1list">List Vehicle Category</h1>
        <table class="tablestyle">
            <tr>
                <th>Category Id</th>
                <th>Name</th>
                <th>Rank</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($data as $key => $Category) { ?>
                <tr>
                    <td><?php echo $Category['category_id'] ?></td>
                    <td><?php echo $Category['name'] ?></td>
                    <td><?php echo $Category['rank'] ?></td>
                    <td>
                        <?php if ($Category['status'] == 1) { ?>
                            <span class="success">Active</span>
                        <?php } else { ?>
                            <span class="un-success">In-active</span>
                        <?php } ?>
                    </td>
                    <td class="actioncol">
                        <a href="update_categories.php?category_id=<?php echo $Category['category_id'] ?>" class="edit">Update</a>
                        <a href="delete_categories.php?category_id=<?php echo $Category['category_id'] ?>" class="del" onclick="return confirm('are you sure to delete?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>
