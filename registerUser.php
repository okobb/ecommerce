<?php

include("./connection.php");


$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $pdo->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?) ");
$stmt->execute([$username,$email,$password]);
$id = $pdo->lastInsertId();

$stmt = $pdo->prepare("INSERT INTO carts(user_id) VALUES(?) ");
$stmt->execute([$id]);


echo "you are user " . $id;