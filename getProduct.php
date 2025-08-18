<?php

include("./connection.php");

$prod_id = $_POST["prodid"];
$stmt = $pdo->prepare("SELECT * FROM products where prod_id = ?");
$stmt->execute([$prod_id]);

$prod = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$prod) {
  echo json_encode([
    "message" => "no products found"
  ]);
} else {
  echo json_encode($prod);
}