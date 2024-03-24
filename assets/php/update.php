<?php
// Establish database connection
$pdo = new PDO('mysql:host=localhost;dbname=db_moneycord', 'root', '');

// Retrieve data from POST request
$jumlah_transaksi = $_POST['jumlah_transaksi'];
$tgl_transaksi = $_POST['tgl_transaksi'];
$deskripsi_transaksi = $_POST['deskripsi_transaksi'];
$jenis_transaksi = $_POST['jenis_transaksi'];

// Update record in the database
$query = $pdo->prepare('UPDATE tb_records SET jumlah_transaksi = :jumlah_transaksi, tgl_transaksi = :tgl_transaksi, deskripsi_transaksi = :deskripsi_transaksi WHERE jenis_transaksi = :jenis_transaksi');
$query->execute(['jumlah_transaksi' => $jumlah_transaksi, 'tgl_transaksi' => $tgl_transaksi, 'deskripsi_transaksi' => $deskripsi_transaksi, 'jenis_transaksi' => $jenis_transaksi]);
?>
