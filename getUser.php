<?php

include("./connection.php");

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  echo json_encode([
    "message" => "no user found having id $id"
  ]);
} else {
  echo json_encode($user);
}