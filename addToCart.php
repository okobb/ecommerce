<?php

include("./connection.php");

$cartId = $_POST["cartid"];
$prodId = $_POST["prodid"];
$quantity = $_POST["quantity"];

$stmt = $pdo->prepare("INSERT INTO cart_items (cart_id, prod_id, quantity) VALUES (?, ?, ?)");
$stmt->execute([$cartId, $prodId, $quantity]);

echo "Item added to cart. ";