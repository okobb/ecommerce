<?php

include("./connection.php");

$email = $_POST["email"];
$orderId = $_POST["orderid"];

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
  $id = $user['id'];

  $stmt = $pdo->prepare("SELECT name,price,description FROM products INNER JOIN order_items on order_items.prod_id = products.prod_id
  INNER JOIN orders on order_items.order_id = orders.order_id  WHERE orders.user_id = ?");
  $stmt->execute([$id]);

  $order = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (!$order) {
    echo json_encode([
      "message" => "no orders found"
    ]);
  } else {
    echo json_encode($order);
  }
}
else {
  echo json_encode("Wrong email or password.");
}