<?php
session_start();
require_once 'data.php';

$carts = !empty($_SESSION['cart']) ? $_SESSION['cart'] : [];

$id = !empty($_POST['id']) ? $_POST['id'] : null;

if (!$id) {
    $id = !empty($_GET['id']) ? $_GET['id'] : null;
}

$type = !empty($_GET['type']) ? $_GET['type'] : 'plus';
if ($id) {
    $productItem = [];

    foreach ($products as $product) {
        if ($product['id'] == $id) {
            $productItem = $product;
        }
    }

    if (!empty($productItem)) {
        $idCart = null;
        foreach ($carts as $cart) {
            if ($cart['id'] == $id) {
                $idCart = $id;
            }
        }

        if ($idCart) {
            if ($type == 'minus') {
                $_SESSION['cart'][$idCart]['quantity'] -= 1;
            } else {
                $_SESSION['cart'][$idCart]['quantity'] += 1;
            }

            $_SESSION['cart'][$idCart]['price'] = $_SESSION['cart'][$idCart]['quantity'] * $productItem['price'];

            if ($_SESSION['cart'][$idCart]['quantity'] == 0) {
                unset($_SESSION['cart'][$idCart]);
            }

        } else {
            $_SESSION['cart'][$id] = [
                'id' => $productItem['id'],
                'name' => $productItem['name'],
                'price' => $productItem['price'],
                'quantity' => 1,
            ];
        }

    } else {
        $_SESSION['error'] = 'Không tìm thấy sản phẩm';
    }
} else {
    $_SESSION['error'] = 'Không có mã sản phẩm';
}

header('Location:  http://localhost/php30/cart/cart_list.php');