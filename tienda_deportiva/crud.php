<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "usuarios");

// Función para obtener todos los productos
function obtenerProductos() {
    global $conexion;
    $query = "SELECT * FROM productos";
    $resultado = mysqli_query($conexion, $query);
    return $resultado;
}

// Si se envía el formulario para agregar un producto
if(isset($_POST['agregar_producto'])) {
    $marca = $_POST['marca'];
    $tipo = $_POST['tipo'];
    $genero = $_POST['genero'];
    $talla = $_POST['talla'];
    $color = $_POST['color'];
    $descripcion = $_POST['descripcion'];
    
    $query = "INSERT INTO productos (marca, tipo, genero, talla, color, descripcion) VALUES ('$marca', '$tipo', '$genero', '$talla', '$color', '$descripcion')";
    mysqli_query($conexion, $query);
}

// Si se envía el formulario para eliminar un producto
if(isset($_POST['eliminar_producto'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM productos WHERE id=$id";
    mysqli_query($conexion, $query);
}

// Si se envía el formulario para deshabilitar un producto
if(isset($_POST['deshabilitar_producto'])) {
    $id = $_POST['id'];
    $query = "UPDATE productos SET habilitado=0 WHERE id=$id";
    mysqli_query($conexion, $query);
}

// Si se envía el formulario para habilitar un producto
if(isset($_POST['habilitar_producto'])) {
    $id = $_POST['id'];
    $query = "UPDATE productos SET habilitado=1 WHERE id=$id";
    mysqli_query($conexion, $query);
}


// Si se envía el formulario para consultar un producto
if(isset($_POST['consultar_producto'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM productos WHERE id=$id";
    $resultado = mysqli_query($conexion, $query);
    $producto = mysqli_fetch_assoc($resultado);
}

// Si se envía el formulario para modificar un producto
if(isset($_POST['modificar_producto'])) {
    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $tipo = $_POST['tipo'];
    $genero = $_POST['genero'];
    $talla = $_POST['talla'];
    $color = $_POST['color'];
    $descripcion = $_POST['descripcion'];
    
    $query = "UPDATE productos SET marca='$marca', tipo='$tipo', genero='$genero', talla='$talla', color='$color', descripcion='$descripcion' WHERE id=$id";
    mysqli_query($conexion, $query);
}

// Obtener todos los productos
$productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <link rel="shortcut icon" href="./producto/icono.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header>
        <div class="logo">
            <h2 class="nombre-empresa">Deporte Total</h2>
        </div>
        <nav>
            <a href="index.html" class="nav-link">Inicio</a>
            <a href="producto.html" class="nav-link">Productos</a>
            <a href="index.html#contactanos" class="nav-link">Contactanos</a>
        </nav>
    </header>
    <h1>Lista de Productos</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Tipo</th>
            <th>Genero</th>
            <th>Talla</th>
            <th>Color</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
        <?php while($fila = mysqli_fetch_assoc($productos)) { ?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['marca']; ?></td>
            <td><?php echo $fila['tipo']; ?></td>
            <td><?php echo $fila['genero']; ?></td>
            <td><?php echo $fila['talla']; ?></td>
            <td><?php echo $fila['color']; ?></td>
            <td><?php echo $fila['descripcion']; ?></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                    <input type="submit" name="eliminar_producto" value="Eliminar">
                </form>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                    <input type="submit" name="deshabilitar_producto" value="Deshabilitar">
                </form>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                    <input type="submit" name="habilitar_producto" value="Habilitar">
                </form>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                    <input type="submit" name="consultar_producto" value="Consultar">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    
    <h2>Agregar Producto</h2>
    <form action="" method="post">
        <label>Marca:</label>
        <input type="text" name="marca" required><br>
        <label>Tipo:</label>
        <input type="text" name="tipo" required><br>
        <label>Genero:</label>
        <input type="text" name="genero" required><br>
        <label>Talla:</label>
        <input type="text" name="talla"><br>
        <label>Color:</label>
        <input type="text" name="color"><br>
        <label>Descripción:</label><br>
        <textarea name="descripcion" rows="4" cols="50"></textarea><br>
        <input type="submit" name="agregar_producto" value="Agregar">
    </form>

    <?php if(isset($producto)) { ?>
        <h2>Consultar Producto</h2>
        <form action="" method="post">
            <label>ID:</label>
            <input type="text" name="id" value="<?php echo $producto['id']; ?>" readonly><br>
            <label>Marca:</label>
            <input type="text" name="marca" value="<?php echo $producto['marca']; ?>"><br>
            <label>Tipo:</label>
            <input type="text" name="tipo" value="<?php echo $producto['tipo']; ?>"><br>
            <label>Genero:</label>
            <input type="text" name="genero" value="<?php echo $producto['genero']; ?>"><br>
            <label>Talla:</label>
            <input type="text" name="talla" value="<?php echo $producto['talla']; ?>"><br>
            <label>Color:</label>
            <input type="text" name="color" value="<?php echo $producto['color']; ?>"><br>
            <label>Descripción:</label><br>
            <textarea name="descripcion" rows="4" cols="50"><?php echo $producto['descripcion']; ?></textarea><br>
            <input type="submit" name="modificar_producto" value="Modificar">
        </form>
    <?php } ?>
</body>
</html>
