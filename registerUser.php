<?php

include("./connection.php");


$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->execute([$email,$password]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  echo json_encode([
    "message" => "email already taken"
  ]);
} else {
  
$stmt = $pdo->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?) ");
$stmt->execute([$username,$email,$password]);
$id = $pdo->lastInsertId();

$stmt = $pdo->prepare("INSERT INTO carts(user_id) VALUES(?) ");
$stmt->execute([$id]);


echo "you are user " . $id;
}