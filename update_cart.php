<?php
session_start();
if (isset($_POST['cart'])) {
    $_SESSION['cart'] = json_decode($_POST['cart'], true);

    foreach ($_SESSION['cart'] as $item) {
        $dish_name = $item['name'];
        $dish_price = $item['price'];
    }
}
?>