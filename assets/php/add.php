<?php
// Establish database connection
$pdo = new PDO('mysql:host=localhost;dbname=db_moneycord', 'root', '');
// Retrieve data from POST request
$name = $_POST['name'];
$email = $_POST['email'];

// Insert new record into the database
$query = $pdo->prepare('INSERT INTO tb_records (name, email) VALUES (:name, :email)');
$query->execute(['name' => $name, 'email' => $email]);
?>
