<?php
// Establish database connection
$pdo = new PDO('mysql:host=localhost;dbname=db_moneycord', 'root', '');

// Retrieve data from POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah_transaksi = $_POST['jumlah_transaksi'];
    $tgl_transaksi = $_POST['tgl_transaksi'];
    $deskripsi_transaksi = $_POST['deskripsi_transaksi'];
    $jenis_transaksi = $_POST['jenis_transaksi'];
}

// Insert new record into the database
$query = $pdo->prepare('INSERT INTO tb_records (jumlah_transaksi, tgl_transaksi, deskripsi_transaksi, jenis_transaksi) VALUES (:jumlah_transaksi, :tgl_transaksi, :deskripsi_transaksi, :jenis_transaksi)');
$query->execute(['jumlah_transaksi' => $jumlah_transaksi, 'tgl_transaksi' => $tgl_transaksi, 'deskripsi_transaksi' => $deskripsi_transaksi, 'jenis_transaksi' => $jenis_transaksi]);

ob_clean();
header("../../index.php");
exit;