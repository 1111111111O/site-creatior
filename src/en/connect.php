<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site";

// Create MySQL connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Connection error check
if (!$conn) {
    die("Bağlantı hatası: " . mysqli_connect_error());
}
?>
