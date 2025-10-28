<?php session_start(); ?>
<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Estilo.css">
    <script src="main.js"></script>
    <title>Mujeres - Flex & Fuel</title>
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
            <a href="#lululemon">Lululemon</a>
        </aside>
        <main class="content">
            <h1>Mujeres</h1>
            <p>Bienvenida a la sección de ropa para mujeres. Selecciona una marca de la izquierda para explorar los productos.</p>
            <section id="gymshark"class="fade-in-scale">
                <h2>Gymshark</h2>
                <div class="productos-container">
                    <div class="producto">
                        <img src="gymshark11.jpg" alt="Gymshark 1">
                        <h3>Leggings Energy</h3>
                        <p>Leggings de compresión con diseño elegante.</p>
                        <p>$999.00</p>
                        <button class="btn-carrito" data-nombre="Leggings Energy" data-precio="999">Añadir al carrito</button>
                        <button class="btn-favoritos">
                            <img src="favoritos-icono.png" alt="Añadir a favoritos">
                        </button>
                    </div>
                    <div class="producto">
                        <img src="gymshark22.jpg" alt="Gymshark 2">
                        <h3>Top Vital</h3>
                        <p>Top deportivo con soporte y comodidad.</p>
                        <p>$699.00</p>
                        <button class="btn-carrito" data-nombre="Top Vital" data-precio="699">Añadir al carrito</button>
                        <button class="btn-favoritos">
                            <img src="favoritos-icono.png" alt="Añadir a favoritos">
                        </button>
                    </div>
                    <div class="producto">
                        <img src="gymshark33.jpg" alt="Gymshark 3">
                        <h3>Short Adapt</h3>
                        <p>Shorts flexibles para cualquier entrenamiento.</p>
                        <p>$599.00</p>
                        <button class="btn-carrito" data-nombre="Short Adapt" data-precio="599">Añadir al carrito</button>
                        <button class="btn-favoritos">
                            <img src="favoritos-icono.png" alt="Añadir a favoritos">
                        </button>
                    </div>
                </div>
            </section>
            <section id="youngla" class="fade-in-scale">
                <h2>Young LA</h2>
                <div class="productos-container">
                    <div class="producto">
                        <img src="youngla11.jpg" alt="Young LA 1">
                        <h3>Joggers Confort</h3>
                        <p>Pantalones cómodos con estilo casual.</p>
                        <p>$1,099.00</p>
                        <button class="btn-carrito" data-nombre="Joggers Confort" data-precio="1099">Añadir al carrito</button>
                        <button class="btn-favoritos">
                            <img src="favoritos-icono.png" alt="Añadir a favoritos">
                        </button>
                    </div>
                    <div class="producto">
                        <img src="youngla22.jpg" alt="Young LA 2">
                        <h3>Camiseta Oversized</h3>
                        <p>Diseño moderno y holgado.</p>
                        <p>$799.00</p>
                        <button class="btn-carrito" data-nombre="Camiseta Oversized" data-precio="799">Añadir al carrito</button>
                        <button class="btn-favoritos">
                            <img src="favoritos-icono.png" alt="Añadir a favoritos">
                        </button>
                    </div>
                    <div class="producto">
                        <img src="youngla33.jpg" alt="Young LA 3">
                        <h3>Sudadera Fit</h3>
                        <p>Perfecta para entrenar o uso diario.</p>
                        <p>$1,299.00</p>
                        <button class="btn-carrito" data-nombre="Sudadera Fit" data-precio="1299">Añadir al carrito</button>
                        <button class="btn-favoritos">
                            <img src="favoritos-icono.png" alt="Añadir a favoritos">
                        </button>
                    </div>
                </div>
            </section>
            <section id="lululemon" class="fade-in-scale">
                <h2>lululemon</h2>
                <div class="productos-container">
                    <div class="producto">
                        <img src="lululemon1.jpeg" alt="Lululemon 1">
                        <h3>Leggings Align</h3>
                        <p>Leggings suaves con soporte premium.</p>
                        <p>$1,499.00</p>
                        <button class="btn-carrito" data-nombre="Leggings Align" data-precio="1499">Añadir al carrito</button>
                        <button class="btn-favoritos">
                            <img src="favoritos-icono.png" alt="Añadir a favoritos">
                        </button>
                    </div>
                    <div class="producto">
                        <img src="lululemon2.jpg" alt="Lululemon 2">
                        <h3>Top Define</h3>
                        <p>Soporte y estilo para entrenamientos.</p>
                        <p>$1,199.00</p>
                        <button class="btn-carrito" data-nombre="Top Define" data-precio="1199">Añadir al carrito</button>
                        <button class="btn-favoritos">
                            <img src="favoritos-icono.png" alt="Añadir a favoritos">
                        </button>
                    </div>
                    <div class="producto">
                        <img src="lululemon3.jpg" alt="Lululemon 3">
                        <h3>Chaqueta Scuba</h3>
                        <p>Aislamiento térmico con diseño elegante.</p>
                        <p>$2,099.00</p>
                        <button class="btn-carrito" data-nombre="Chaqueta Scuba" data-precio="2099">Añadir al carrito</button>
                        <button class="btn-favoritos">
                            <img src="favoritos-icono.png" alt="Añadir a favoritos">
                        </button>
                    </div>
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
