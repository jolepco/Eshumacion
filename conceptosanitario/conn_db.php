<?php
$servername = "172.16.1.54";
$database = "pruebas_concepto";
$username = "pruebas_concepto";
$password = "C0nc3pt02019*";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($conn);
?>
