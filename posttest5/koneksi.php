<?php
$host = 'localhost';
$username = 'root'; 
$password = ''; 
$database = 'alat_musik'; 

$kon = mysqli_connect($host, $username, $password, $database);

if (!$kon) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
