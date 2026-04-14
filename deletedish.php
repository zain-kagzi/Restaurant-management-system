<?php

include('connection.php');
$dish = $_GET['id'];

$sql="DELETE from menu_items where id = '$dish'";
$result=mysqli_query($con,$sql);

echo '<script>alert("Dish DELETED SUCCESFULLY")</script>';
echo '<script> window.location.href = "admindish.php";</script>';

?>