<?php
// Example connection using PDO
$pdo = new PDO('mysql:host=localhost;dbname=db_moneycord', 'root', '');

// Fetch records
$query = $pdo->query('SELECT * FROM tb_records');
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '<p>' . $row['jumlah_transaksi'] . ' - ' . $row['tgl_transaksi'] .  ' - ' . $row['deskripsi_transaksi'] .  ' - ' . $row['_transaksi'] . ' <button class="delete" data-id="' . $row['id'] . '">Delete</button></p>';
}
?>
