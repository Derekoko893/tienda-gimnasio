<?php session_start(); ?>
<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipamiento - Flex & Fuel</title>
    <link rel="stylesheet" href="Estilo.css">
    <style>
        /* Estilos CSS (sin cambios) */
        body { margin: 0; font-family: 'Arial', sans-serif; background-color: #f5f5f5; }
        .header { background-color: #000; color: #fff; display: flex; align-items: center; justify-content: space-between; padding: 10px 20px; }
        .header img { height: 40px; }
        .nav { display: flex; gap: 30px; }
        .nav a { color: #fff; text-decoration: none; font-weight: bold; font-size: 16px; position: relative; overflow: hidden; }
        .nav a:before { content: ''; position: absolute; left: 0; bottom: 100%; height: 2px; width: 100%; background-color: #FFD700; transition: bottom 0.3s ease; z-index: -1; }
        .nav a:hover:before { bottom: 0; }
        .nav a:hover { color: #FFD700; }
        .container { display: flex; padding: 20px; }
        .sidebar { width: 200px; background-color: #000; color: #fff; padding: 10px; border-radius: 5px; position: relative; height: fit-content; }
        .sidebar h2 { font-size: 18px; margin-bottom: 15px; }
        .sidebar a { display: block; color: #fff; text-decoration: none; margin: 5px 0; }
        .sidebar a:hover { color: #FFD700; }
        .divider { height: 100%; width: 2px; background-color: #FFD700; position: absolute; left: 100%; top: 0; }
        .content { flex-grow: 1; max-width: 1200px; margin: 0 auto; text-align: center; }
        h1 { text-align: center; font-size: 48px; font-weight: bold; margin-bottom: 20px; color: #000; }
        h2 { text-align: center; font-size: 28px; margin-top: 20px; margin-bottom: 15px; color: #333; }
        .productos-container { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
    </style>
</head>
<body>
    <div class="mensaje-carrito" id="mensaje-carrito">Producto añadido al carrito</div>
    <header class="header">
        <a href="PaginaPrincipal.php">
            <img src="LOGO CON LETRAS.PNG" alt="Logo" />
        </a>
        <nav class="nav">
            <a href="equipamiento.php">Equipamiento</a>
            <a href="ropa.php">Ropa</a>
            <a href="suplementacion.php">Suplementación</a>
            <a href="accesorios.php">Accesorios</a>
           <?php if (isset($_SESSION['usuario_id'])): ?>
    <a href="#">Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></a>
    <a href="logout.php">Cerrar Sesión</a>
<?php else: ?>
    <a href="login.php">Iniciar Sesión</a>
    <a href="registro.php">Regístrate</a>
<?php endif; ?>
        </nav>
        <a href="carrito.php" class="icono-carrito">
            <img src="carrito-icono.png" alt="Carrito" /> 
        </a>
    </header>
    <div class="container">
        <aside class="sidebar">
            <h2>Categorías</h2>
            <a href="#straps">Straps</a>
            <a href="#muñequeras">Muñequeras</a>
            <a href="#rodilleras">Rodilleras</a>
            <a href="#cinturones">Cinturones</a>
            <a href="#coderas">Coderas</a>
            <a href="#calzado">Calzado</a>
            <div class="divider"></div>  
        </aside>
        <main class="content">
            <h1>Equipamiento</h1>
            <p>Bienvenido a la sección de equipamiento. Selecciona una categoría de la izquierda para explorar los productos.</p>
                
                <?php
                // --- INICIO FUNCIÓN AUXILIAR ---
                // Para no repetir el mismo código HTML 6 veces, creo una función
                // que dibuja la sección de productos.
                
                function mostrarProductos($conexion, $subcategoria) {
                    $sql = "SELECT * FROM Productos WHERE categoria = 'Equipamiento' AND subcategoria = '$subcategoria'";
                    $resultado = $conexion->query($sql);
                    
                    if ($resultado->num_rows > 0) {
                        while($producto = $resultado->fetch_assoc()) {
                ?>
                            <div class="producto">
                                <img src="<?php echo $producto['imagen_url']; ?>" alt="<?php echo $producto['nombre']; ?>">
                                <h3><?php echo $producto['nombre']; ?></h3>
                                <p><?php echo $producto['descripcion']; ?></p>
                                <p>$<?php echo number_format($producto['precio'], 2); ?></p>
                                <button class="btn-carrito" data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>" data-precio="<?php echo $producto['precio']; ?>">Añadir al carrito</button>
                                <button class="btn-favoritos"><img src="favoritos-icono.png" alt="Añadir a favoritos"></button>
                            </div>
                            <?php
                        } // Fin del while
                    } else { 
                        echo "<p>No hay productos en esta categoría.</p>"; 
                    } // Fin del if
                }
                // --- FIN FUNCIÓN AUXILIAR ---
                ?>

                <section id="straps" class="fade-in-scale">
                    <h2>Straps</h2>
                    <div class="productos-container">
                        <?php mostrarProductos($conexion, 'Straps'); ?>
                    </div>
                </section>
                
                <section id="muñequeras" class="fade-in-scale">
                    <h2>Muñequeras</h2>
                    <div class="productos-container">
                        <?php mostrarProductos($conexion, 'Muñequeras'); ?>
                    </div>
                </section>
                
                <section id="rodilleras" class="fade-in-scale">
                    <h2>Rodilleras</h2>
                    <div class="productos-container">
                        <?php mostrarProductos($conexion, 'Rodilleras'); ?>
                    </div>
                </section>                
                
                <section id="cinturones" class="fade-in-scale">
                    <h2>Cinturones</h2>
                    <div class="productos-container">
                         <?php mostrarProductos($conexion, 'Cinturones'); ?>
                    </div>
                </section>
                
                <section id="coderas" class="fade-in-scale">
                    <h2>Coderas</h2>
                    <div class="productos-container">
                        <?php mostrarProductos($conexion, 'Coderas'); ?>
                    </div>
                </section>
                
                <section id="calzado" class="fade-in-scale">
                    <h2>Calzado</h2>
                    <div class="productos-container">
                        <?php mostrarProductos($conexion, 'Calzado'); ?>
                    </div>
                </section>
                
        </main>
    </div>
    <script src="main.js"></script>
</body>
</html>