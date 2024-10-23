<?php
include 'config.php';  // Incluye la conexión a la base de datos

$query = "SELECT promociones.nombre, promociones.precio_descuento, carrito.cantidad
          FROM carrito
          INNER JOIN promociones ON carrito.id_producto = promociones.id_producto
          WHERE carrito.id_comprador = 1";  // Ajusta según el comprador

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '    <td>'.$row['nombre'].'</td>';
        echo '    <td>'.$row['precio_descuento'].'</td>';
        echo '    <td>'.$row['cantidad'].'</td>';
        echo '</tr>';
    }
} else {
    echo "El carrito está vacío.";
}
?>
