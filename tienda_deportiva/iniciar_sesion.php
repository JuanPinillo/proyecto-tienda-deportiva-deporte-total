<?php
require_once 'config.php';

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error_message = "Por favor, llene todos los campos.";
    } else {
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['email'] = $email;
                header('Location: producto.html');
                exit;
            } else {
                $error_message = "Contraseña incorrecta";
            }
        } else {
            $error_message = "Email no encontrado";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesión</title>
    <link rel="shortcut icon" href="./producto/icono.jpg" type="image/x-icon">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
    <h1>Inicio de sesión</h1>
    <form action="iniciar_sesion.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
    <div id="error-message"><?php echo $error_message; ?></div>
    <button><a href="registro.php" class="button">Registrarse</a></button>
</div>
</body>
</html>
