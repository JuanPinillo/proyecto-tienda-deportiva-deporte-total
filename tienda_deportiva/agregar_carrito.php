<?php
include 'config.php';  // Incluye la conexión a la base de datos

if (isset($_POST['agregar_carrito'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = 1;

    $id_comprador = 1;  // Ajusta según el comprador actual
    $sql = "INSERT INTO carrito (id_comprador, id_producto, cantidad) 
            VALUES ($id_comprador, $id_producto, $cantidad)";

    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado al carrito.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
