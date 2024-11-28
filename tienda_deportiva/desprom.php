<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./index/icono.jpg" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <?php include 'config.php'; ?> <!-- Conexión a la base de datos -->

    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="four columns">
                    <img src="img/logo.png" id="logo">
                </div>
                <div class="two columns u-pull-right">
                    <ul>
                        <li class="submenu">
                                <img src="img/cart.png" id="img-carrito">
                                <div id="carrito">
                                    <table id="lista-carrito" class="u-full-width">
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include 'mostrar_carrito.php'; ?> <!-- Carga el carrito dinámicamente -->
                                        </tbody>
                                    </table>
                                    <p id="total">Total: $0.00</p>
                                    <a href="#" id="vaciar-carrito" class="button u-full-width">Vaciar Carrito</a>
                                    <div id="datos-comprador">
    <h2>Detalles del Comprador</h2>
    <form action="guardar_comprador.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" required>
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" id="email" required>

        <button type="submit" class="button u-full-width">Finalizar Compra</button>
    </form>
</div>

                                </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div id="lista-cursos" class="container">
        <h1 id="encabezado" class="encabezado">Descuentos y Promociones</h1>
        <div class="row">
            <?php include 'promociones.php'; ?> <!-- Carga los productos dinámicamente -->
        </div>
    </div>

    <footer id="footer" class="footer">
        <div class="container">
            <div class="row">
                <div class="four columns">
                    <nav id="principal" class="menu">
                        <a class="enlace" href="#">Inicio</a>
                        <a class="enlace" href="#">Productos</a>
                        <a class="enlace" href="#">Insagram</a>
                        <a class="enlace" href="#">Soporte</a>
                        <a class="enlace" href="#">Temas</a>
                    </nav>
                </div>
                <div class="four columns">
                    <nav id="secundaria" class="menu">
                        <a class="enlace" href="#">¿Quienes Somos?</a>
                        <a class="enlace" href="#">Empleo</a>
                        <a class="enlace" href="#">Blog</a>
                        <a href="cerrar_sesion.php">Cerrar Sesion</a>
                        <a href="index.html">Inicio</a>
                    </nav>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/app.js"></script>
</body>
</html>
