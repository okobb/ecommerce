<?php

include("./connection.php");


$stmt = $pdo->prepare("SELECT * FROM categories");
$stmt->execute();

$cat = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$cat) {
  echo json_encode([
    "message" => "no categories found"
  ]);
} else {
  echo json_encode($cat);
}