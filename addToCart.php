<?php

include("./connection.php");

$email = $_POST["email"];
$prodId = $_POST["prodid"];
$quantity = $_POST["quantity"];

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $id = $user['id'];
}

$stmt = $pdo->prepare("SELECT cart_id FROM carts WHERE user_id = ?");
$stmt->execute([$id]);
$cart_id = $stmt->fetch(PDO::FETCH_ASSOC);

if ($cart_id) {
    $cartId = $cart_id['cart_id'];
}
$stmt = $pdo->prepare("Insert INTO cart_items(cart_id,prod_id,quantity) values(?,?,?)");
$stmt->execute([$cartId,$prodId,$quantity]);

