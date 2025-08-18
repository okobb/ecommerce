<?php

include("./connection.php");

$email = $_POST["email"];

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $id = $user['id'];
}

$stmt = $pdo->prepare("SELECT name,price,description FROM products INNER JOIN cart_items ON products.prod_id = cart_items.prod_id
INNER JOIN carts on cart_items.cart_id = carts.cart_id  WHERE carts.user_id = ?");
$stmt->execute([$id]);

$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$cart) {
  echo json_encode([
    "message" => "no products found"
  ]);
} else {
  echo json_encode($cart);
}