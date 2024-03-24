<?php
/* Koneksi database dengan metode mysqli */
function getConnection()
{
    $server = 'localhost';
    $host = 3306;
    $username = 'root';
    $password = '';
    $dbName = 'db_moneycord';

    return mysqli_connect($server, $username, $password, $dbName);
}
