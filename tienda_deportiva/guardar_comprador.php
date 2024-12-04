<?php
// Incluir conexión a la base de datos
include('config.php');

// Verificar que los datos hayan sido enviados correctamente
if (isset($_POST['nombre']) && isset($_POST['direccion']) && isset($_POST['email'])) {

    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];

    // Preparar la consulta para insertar los datos usando sentencias preparadas
    $stmt = $conn->prepare("INSERT INTO compradores (nombre, direccion, email) VALUES (?, ?, ?)");

    // Comprobar si la preparación fue exitosa
    if ($stmt === false) {
        echo "Error en la preparación de la consulta: " . $conn->error;
        exit;
    }

    // Enlazar los parámetros con las variables
    $stmt->bind_param("sss", $nombre, $direccion, $email);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir a una página que muestre el mensaje de éxito
        echo "<script>alert('Compra finalizada correctamente');</script>";
        
        // Vaciar el carrito después de la compra y generar factura
        echo "<script>
                localStorage.removeItem('carrito'); 
                window.location.href = 'desprom.php?nombre=" . urlencode($nombre) . "&direccion=" . urlencode($direccion) . "&email=" . urlencode($email) . "';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la consulta preparada
    $stmt->close();
} else {
    echo "Faltan datos en el formulario";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
