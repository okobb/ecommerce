<?php

include("./connection.php");


$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $pdo->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?) ");
$stmt->execute([$username,$email,$password]);
$id = $pdo->lastInsertId();

echo "you are user " . $id;