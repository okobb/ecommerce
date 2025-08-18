<?php

include("./connection.php");


$description = $_POST["description"];
$name = $_POST["name"];
$price = $_POST["price"];
$category = $_POST["category"];

$stmt = $pdo->prepare("INSERT INTO products(description,name,price,category) VALUES(?,?,?,?) ");
$stmt->execute([$description,$name,$price,$category]);
$id = $pdo->lastInsertId();

echo "Product " . $id . " created.";