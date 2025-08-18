<?php

include("./connection.php");


$stmt = $pdo->prepare("SELECT * FROM products inner join categories on products.cat_id = categories.cat_id ORDER by category  ");
$stmt->execute();

$prod = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$prod) {
  echo json_encode([
    "message" => "no products found"
  ]);
} else {
  echo json_encode($prod);
}