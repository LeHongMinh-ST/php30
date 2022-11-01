<?php
session_start();
$id = !empty($_POST['id']) ? $_POST['id'] : null;
$carts = !empty($_SESSION['cart']) ? $_SESSION['cart'] : [];
if ($id) {
    foreach ($carts as $cart) {
        if ($cart['id'] == $id) {
            unset($_SESSION['cart'][$id]);
        }
    }
} else {
 $_SESSION['error'] = 'Lỗi';
}

header('Location:  http://localhost/php30/cart/cart_list.php');

