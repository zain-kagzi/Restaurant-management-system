<?php

include('connection.php');
$email=$_GET['id'];

$sql="DELETE from users where email='$email'";
$result=mysqli_query($con,$sql);

echo '<script>alert("USER DELETED SUCCESFULLY")</script>';
echo '<script> window.location.href = "adminusers.php";</script>';

?>