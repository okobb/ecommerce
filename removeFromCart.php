<?php

include("./connection.php");

$email = $_POST["email"];
$prodId = $_POST["prodid"];

$email = $_POST["email"];
$password = $_POST["password"];

include("./loginUser.php");

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $id = $user['id'];


$stmt = $pdo->prepare("SELECT cart_id FROM carts WHERE user_id = ?");
$stmt->execute([$id]);
$cart_id = $stmt->fetch(PDO::FETCH_ASSOC);

if ($cart_id) {
    $cartId = $cart_id['cart_id'];
}
$stmt = $pdo->prepare("DELETE FROM cart_items WHERE cart_id = ? AND prod_id = ?");
$stmt->execute([$cartId,$prodId]);

if($stmt)
{
    echo "Item removed from cart.";
}
else{
    echo "failed to remove item from cart.";
}
} else {
    echo json_encode("Wrong email or password.");
}

