<?php
include('connection.php');
error_reporting(0);
ob_clean();



// Get category from the AJAX request
$category = isset($_GET['category']) ? $con->real_escape_string($_GET['category']) : 'Best';

// Fetch menu items based on the category
$sql = "SELECT id,name, image_path,price FROM menu_items WHERE type = '$category'";
$result = $con->query($sql);

$menuItems = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menuItems[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($menuItems);

$con->close();
?>
