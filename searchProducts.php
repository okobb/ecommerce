<?php

include("./connection.php");

$key = $_GET["search"];
$search = "%" . $key . "%";

$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ?");
$stmt->execute([$search,$search]);

$prod = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$prod) {
  echo json_encode([
    "message" => "no products found matching the name or description"
  ]);
} else {
  echo json_encode($prod);
}