<?php

include("./connection.php");

$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->execute([$email,$password]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  echo json_encode([
    "message" => "wrong email or password"
  ]);
} else {
  echo json_encode([
    "message" => "you are logged in"
  ]);
}