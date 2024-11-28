<?php
require_once 'config.php';
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) {
    echo "<script>
        alert('Debes iniciar sesión para realizar una compra.');
        window.history.back(); // Regresa a la página anterior
    </script>";
    exit;
}

// Obtener el ID del usuario logueado
$id_usuario = $_SESSION['id'];

// Obtener los datos enviados desde el formulario
$nombre = $_POST['nombre'] ?? null;
$direccion = $_POST['direccion'] ?? null;
$email = $_POST['email'] ?? null;

// Validar los datos
if (empty($nombre) || empty($direccion) || empty($email)) {
    echo "<script>
        alert('Por favor, completa todos los campos.');
        window.history.back(); // Regresa a la página anterior
    </script>";
    exit;
}

// Preparar la consulta para insertar los datos del comprador
$sql = "INSERT INTO compradores (nombre, direccion, email, id_usuario) 
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql); // Preparar la consulta para evitar inyecciones SQL
$stmt->bind_param("sssi", $nombre, $direccion, $email, $id_usuario);

if ($stmt->execute()) {
    echo "<script>
        alert('La compra fue finalizada con éxito.');
        window.history.back(); // Regresa a la página anterior
    </script>";
    exit;
} else {
    echo "<script>
        alert('Hubo un error al registrar la compra: " . $stmt->error . "');
        window.history.back(); // Regresa a la página anterior
    </script>";
}

$stmt->close();
$conn->close();
?>
