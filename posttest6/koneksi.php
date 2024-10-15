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
<?php
$kon = mysqli_connect("localhost", "root", "", "alat_musik");

if (!$kon) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>

