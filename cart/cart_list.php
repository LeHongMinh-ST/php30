<?php
session_start();
$products = !empty($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalPrice = 0;

foreach ($products as $product) {
    $totalPrice += $product['price'];
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div>
    <div class="header mb-3">
        <a href="index.php" class="btn btn-success">Danh sách</a>
    </div>

    <?php if (!empty($_SESSION['error'])) {?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error']; unset($_SESSION['error']);?>
        </div>
    <?php }?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Mã sản phẩm</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Giá</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product) { ?>
            <tr>

                <th scope="row"><?= $product['id'] ?></th>
                <td><?= $product['name'] ?></td>
                <td><?= number_format($product['price']) ?></td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <a class="btn btn-outline-secondary" href="add_process.php?id=<?= $product['id'] ?>&type=minus" type="button">-</a>
                                <input type="text" class="form-control" placeholder="" value="<?= $product['quantity'] ?>" aria-label=""
                                   aria-describedby="basic-addon1">
                            <a class="btn btn-outline-secondary" href="add_process.php?id=<?= $product['id'] ?>&type=plus" type="button">+</a>

                        </div>
                    </div>
                </td>
                <td>
                    <form action="delete_process.php" method="post">
                        <input type="text" name="id" hidden value="<?= $product['id'] ?>">
                        <button type="submit" class="btn btn-danger">Xoá</button>
                    </form>
                </td>
            </tr>

        <?php } ?>
        </tbody>
    </table>
    <div>
        Tổng tiền: <?= number_format($totalPrice) ?>
    </div>
</div>
</body>
</html>
