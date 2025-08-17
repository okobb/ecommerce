<?php

include("./connection.php");


$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();

$prod = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$prod) {
  echo json_encode([
    "message" => "no user found having id $id"
  ]);
} else {
  echo json_encode($prod);
}