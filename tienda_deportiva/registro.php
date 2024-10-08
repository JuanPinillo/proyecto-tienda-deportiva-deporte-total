<?php
require_once 'config.php';

$error_message = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($nombre) || empty($email) || empty($password)) {
        $error_message = "Por favor, llene todos los campos.";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Registro exitoso";
        } else {
            $error_message = "Error al registrar el usuario: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="shortcut icon" href="./producto/icono.jpg" type="image/x-icon">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
    <h1>Regístrate</h1>
    <form action="registro.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Registrarse">
    </form>
    <div id="error-message"><?php echo $error_message; ?></div>
    <div id="success-message"><?php echo $success_message; ?></div>
    <button><a href="iniciar_sesion.php" class="button">Iniciar sesión</a></button>
</div>
</body>
</html>
