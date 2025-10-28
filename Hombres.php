<?php session_start(); ?>
<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="Estilo.css">
    <script src="main.js"></script>

    <title>Hombres - Flex & Fuel</title>
    <style>
        .container {
            display: flex;
            padding: 20px;
        }
        .sidebar {
            width: 200px;
            background-color: #000;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            position: relative;
        }
        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 15px;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            margin: 5px 0;
        }
        .sidebar a:hover {
            color: #FFD700; 
        }
        .content {
            flex-grow: 1;
            padding-left: 20px;
        }
        .content {
        flex-grow: 1;
        max-width: 1200px;
        margin: 0 auto;
        text-align: center;
    }

         h1 {
        text-align: center;
        font-size: 48px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #000;
    }

        h2 {
        text-align: center;
        font-size: 28px;
        margin-top: 20px;
        margin-bottom: 15px;
        color: #333;
    }

        .productos-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    </style>
</head>
<div class="mensaje-carrito" id="mensaje-carrito">Producto añadido al carrito</div>
<body>
    <header class="header">
        <a href="PaginaPrincipal.php">
            <img src="LOGO CON LETRAS.PNG" alt="Logo" />
        </a>
        <nav class="nav">
            <a href="Equipamiento.php">Equipamiento</a>
            <a href="Ropa.php">Ropa</a>
            <a href="Suplementacion.php">Suplementación</a>
            <a href="Accesorios.php">Accesorios</a>
            <?php if (isset($_SESSION['usuario_id'])): ?>
    <a href="#">Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></a>
    <a href="logout.php">Cerrar Sesión</a>
<?php else: ?>
    <a href="login.php">Iniciar Sesión</a>
    <a href="registro.php">Regístrate</a>
<?php endif; ?>
        </nav>
        <a href="Carrito.php" class="icono-carrito">
            <img src="carrito-icono.png" alt="Carrito" />  
        </a>
    </header>
    <div class="container">
        <aside class="sidebar">
            <h2>Marcas</h2>
            <a href="#gymshark">Gymshark</a>
            <a href="#youngla">Young LA</a>
            <a href="#alphalete">Alphalete</a>
        </aside>
        <main class="content">
            <h1>Hombres</h1>
            <p>Bienvenido a la sección de ropa para hombres. Selecciona una marca de la izquierda para explorar los productos.</p>
<section id="gymshark" class="fade-in-scale">
    <h2>Gymshark</h2>
    <div class="productos-container">

        <?php
        // 1. Escribimos la consulta SQL (para Gymshark)
        $sql_gymshark = "SELECT * FROM Productos 
                         WHERE genero = 'Hombre' 
                         AND categoria = 'Ropa' 
                         AND nombre LIKE 'Gymshark%'";
        
        // 2. Ejecutamos la consulta
        $resultado = $conexion->query($sql_gymshark);

        // 3. Revisamos si hay productos
        if ($resultado->num_rows > 0) {
            
            // 4. Creamos un "molde" HTML para cada uno
            while($producto = $resultado->fetch_assoc()) {
        ?>

        <div class="producto">
            <img src="<?php echo $producto['imagen_url']; ?>" alt="<?php echo $producto['nombre']; ?>">
            <h3><?php echo $producto['nombre']; ?></h3>
            <p><?php echo $producto['descripcion']; ?></p>
            <p>$<?php echo number_format($producto['precio'], 2); ?></p>
            
            <button class="btn-carrito" 
                    data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                    data-precio="<?php echo $producto['precio']; ?>">
                Añadir al carrito
            </button>
            <button class="btn-favoritos">
                <img src="favoritos-icono.png" alt="Añadir a favoritos">
            </button>
        </div>
        <?php
            } // Fin del "while"
        } else {
            // Si no se encontraron productos
            echo "<p>No hay productos de esta marca por el momento.</p>";
        }
        ?>
        
    </div>
</section>
<section id="youngla" class="fade-in-scale">
    <h2>Young LA</h2>
    <div class="productos-container">

        <?php
        // 1. Escribimos la consulta SQL (¡cambia el LIKE!)
        $sql_youngla = "SELECT * FROM Productos 
                        WHERE genero = 'Hombre' 
                        AND categoria = 'Ropa' 
                        AND nombre LIKE 'Young LA%'";
        
        // 2. Ejecutamos la consulta
        $resultado = $conexion->query($sql_youngla);

        // 3. Revisamos si hay productos
        if ($resultado->num_rows > 0) {
            
            // 4. Creamos un "molde" HTML para cada uno
            while($producto = $resultado->fetch_assoc()) {
        ?>

        <div class="producto">
            <img src="<?php echo $producto['imagen_url']; ?>" alt="<?php echo $producto['nombre']; ?>">
            <h3><?php echo $producto['nombre']; ?></h3>
            <p><?php echo $producto['descripcion']; ?></p>
            <p>$<?php echo number_format($producto['precio'], 2); ?></p>
            
            <button class="btn-carrito" 
                    data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                    data-precio="<?php echo $producto['precio']; ?>">
                Añadir al carrito
            </button>
            <button class="btn-favoritos">
                <img src="favoritos-icono.png" alt="Añadir a favoritos">
            </button>
        </div>
        <?php
            } // Fin del "while"
        } else {
            // Si no se encontraron productos
            echo "<p>No hay productos de esta marca por el momento.</p>";
        }
        ?>
        
    </div>
</section>
<section id="alphalete" class="fade-in-scale">
    <h2>Alphalete</h2>
    <div class="productos-container">

        <?php
        // 1. Escribimos la consulta SQL (¡cambia el LIKE!)
        $sql_alphalete = "SELECT * FROM Productos 
                          WHERE genero = 'Hombre' 
                          AND categoria = 'Ropa' 
                          AND nombre LIKE 'Alphalete%'";
        
        // 2. Ejecutamos la consulta
        $resultado = $conexion->query($sql_alphalete);

        // 3. Revisamos si hay productos
        if ($resultado->num_rows > 0) {
            
            // 4. Creamos un "molde" HTML para cada uno
            while($producto = $resultado->fetch_assoc()) {
        ?>

        <div class="producto">
            <img src="<?php echo $producto['imagen_url']; ?>" alt="<?php echo $producto['nombre']; ?>">
            <h3><?php echo $producto['nombre']; ?></h3>
            <p><?php echo $producto['descripcion']; ?></p>
            <p>$<?php echo number_format($producto['precio'], 2); ?></p>
            
            <button class="btn-carrito" 
                    data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                    data-precio="<?php echo $producto['precio']; ?>">
                Añadir al carrito
            </button>
            <button class="btn-favoritos">
                <img src="favoritos-icono.png" alt="Añadir a favoritos">
            </button>
        </div>
        <?php
            } // Fin del "while"
        } else {
            // Si no se encontraron productos
            echo "<p>No hay productos de esta marca por el momento.</p>";
        }
        ?>

    </div>
</section>
        </main>
    </div>
    <footer class="pie-pagina">
        <div class="contenedor-formulario">
            <h3>¡Suscríbete para recibir noticias!</h3>
            <form action="PaginaPrincipal.php" method="POST" class="formulario-noticias">
                <input type="email" name="email" placeholder="Ingresa tu correo electrónico" required>
                <button type="submit" class="boton-enviar">Enviar</button>
            </form>
        </div>
    </footer> 
</body>
</html>
