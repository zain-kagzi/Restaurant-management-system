<?php

include('connection.php');
$order = $_GET['id'];

$sql="DELETE from orders where id = '$order'";
$result=mysqli_query($con,$sql);

echo '<script>alert("Order DELETED SUCCESFULLY")</script>';
echo '<script> window.location.href = "orders.php";</script>';

?>