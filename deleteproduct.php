<?php

include("./connection.php");

$prod_id = $_POST["prodid"];


$stmt = $pdo->prepare("DELETE FROM products WHERE prod_id = ?");
$stmt->execute([$prod_id]);

echo "Product " . $prod_id . " deleted.";