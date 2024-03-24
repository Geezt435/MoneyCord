<?php
// Establish database connection
$pdo = new PDO('mysql:host=localhost;dbname=db_moneycord', 'root', '');

// Retrieve ID_transaksi from POST request
$id_transaksi = $_POST['id_transaksi'];

// Delete record from the database
$query = $pdo->prepare('DELETE FROM tb_records WHERE id_transaksi = :id_transaksi');
$query->execute(['id_transaksi' => $id_transaksi]);
?>
