<?php

include("./connection.php");

$prod_id = $_POST["prodid"];
$stmt = $pdo->prepare("SELECT description,name,price,category FROM products WHERE prod_id = ?");
$stmt->execute([$prod_id]);

$prod = $stmt->fetch(PDO::FETCH_ASSOC);
$description = $prod['description'];  
$name = $prod['name'];
$price = $prod['price'];
$category = $prod['category'];

if(!empty($_POST["description"]))
{
    $description = $_POST["description"];
}
if(!empty($_POST["name"]))
{
    $name = $_POST["name"];
}
if(!empty($_POST["price"]))
{
    $price = $_POST["price"];

}
if(!empty($_POST["category"]))
{
    $category = $_POST["category"];
}
$stmt = $pdo->prepare("UPDATE products SET description = ?,name = ?,price = ?,category = ? WHERE prod_id = ?");
$stmt->execute([$description,$name,$price,$category,$prod_id]);

echo "Product " . $prod_id . " updated.";