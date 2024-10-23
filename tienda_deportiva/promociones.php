<?php
include 'config.php';  // Incluye el archivo de conexión

$query = "SELECT * FROM promociones";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="four columns">';
        echo '    <div class="card">';
        echo '        <img src="'.$row['imagen'].'" class="imagen-curso u-full-width">';
        echo '        <div class="info-card">';
        echo '            <h4>'.$row['nombre'].'</h4>';
        echo '            <p>'.$row['marca'].'</p>';
        echo '            <img src="img/estrellas.png">';
        echo '            <p class="precio">'.$row['precio_original'].' <span class="u-pull-right ">'.$row['precio_descuento'].'</span></p>';
        echo '            <a href="#" class="u-full-width button-primary button input agregar-carrito" data-id="'.$row['id_producto'].'">Agregar Al Carrito</a>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo "No hay productos disponibles.";
}
?>
