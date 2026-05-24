<?php

$servername = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$database = getenv('DB_NAME') ?: 'keper2';

// Membuat koneksi
$koneksi = mysqli_connect($servername, $username, $password, $database);

?>
