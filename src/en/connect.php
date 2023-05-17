<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site";

// MySQL bağlantısı oluşturma
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if (!$conn) {
    die("Bağlantı hatası: " . mysqli_connect_error());
}
?>
