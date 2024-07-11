<?php
include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$stmt = $pdo->prepare("INSERT INTO products (name, description, category, price, stock, image, location) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$data['name'], $data['description'], $data['category'], $data['price'], $data['stock'], $data['image'], $data['location']]);

echo json_encode(['id' => $pdo->lastInsertId()]);
?>
