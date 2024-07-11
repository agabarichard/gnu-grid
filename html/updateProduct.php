<?php
include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, category = ?, price = ?, stock = ?, image = ?, location = ? WHERE id = ?");
$stmt->execute([$data['name'], $data['description'], $data['category'], $data['price'], $data['stock'], $data['image'], $data['location'], $data['id']]);

echo json_encode(['message' => 'Product updated']);
?>
