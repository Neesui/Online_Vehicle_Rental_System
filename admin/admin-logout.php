<?php 
session_start();
session_destroy();
setcookie('username',null,time()-1);
header('location:index.php');
 ?>