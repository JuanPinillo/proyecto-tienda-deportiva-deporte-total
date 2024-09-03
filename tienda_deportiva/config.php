<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'usuarios';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}