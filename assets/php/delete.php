<?php
// Establish database connection
$pdo = new PDO('mysql:host=localhost;dbname=db_moneycord', 'root', '');

// Retrieve ID from POST request
$id = $_POST['id'];

// Delete record from the database
$query = $pdo->prepare('DELETE FROM tb_records WHERE id = :id');
$query->execute(['id' => $id]);
?>
