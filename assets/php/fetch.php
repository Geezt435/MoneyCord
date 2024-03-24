<?php
// Establish database connection

// Example connection using PDO
$pdo = new PDO('mysql:host=localhost;dbname=db_moneycord', 'root', '');

// Fetch records
$query = $pdo->query('SELECT * FROM tb_records');
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '<p>' . $row['name'] . ' - ' . $row['email'] . ' <button class="delete" data-id="' . $row['id'] . '">Delete</button></p>';
}
?>
