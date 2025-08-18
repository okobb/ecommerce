<?php

include("./connection.php");

$email = $_POST["email"];

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $id = $user['id'];


$stmt = $pdo->prepare("SELECT cart_id FROM carts WHERE user_id = ?");
$stmt->execute([$id]);
$cart_id = $stmt->fetch(PDO::FETCH_ASSOC);

if ($cart_id) {
    $cartId = $cart_id['cart_id'];
}

$stmt = $pdo->prepare("SELECT prod_id, quantity FROM cart_items WHERE cart_id = ?");
$stmt->execute([$cartId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("INSERT INTO orders (user_id) VALUES (?)");
$stmt->execute([$id]);
$orderId = $pdo->lastInsertId();

$stmt = $pdo->prepare("INSERT INTO order_items (order_id, prod_id, quantity) VALUES (?, ?, ?)");
foreach ($cartItems as $item) {
    $stmt->execute([$orderId, $item['prod_id'], $item['quantity']]);
}

$stmt = $pdo->prepare("DELETE FROM cart_items WHERE cart_id = ?");
    $stmt->execute([$cartId]);

if($stmt)
{
    echo "Order created.";
}
else{
    echo "failed to create order.";
}
} else {
    echo json_encode("Wrong email or password");
}
