<?php
include ('connection.php');

// Get the POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $tick = '&#10003;';

    if ($id > 0 && !empty($status)) {
        // Update the order status in the database
        $sql = "UPDATE orders SET order_status = ?,delivery = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssi", $status,$tick, $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Order status updated successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update order status"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid input"]);
    }
}

$con->close();
?>
