<?php session_start(); ?>
<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Estilo.css">
    <script src="main.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <title>Flex & Fuel</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .Video_inicio {
            position: relative; 
            width: 100%;
            max-height: 700px;
            overflow: hidden;
        }
        .Video_inicio video {
            width: 100%;
            height: auto;
            filter: blur(8px);
            transform: scale(1.1);
        }
        .Video_inicio::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .Video_overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            z-index: 2;
            font-family: 'Pacifico', cursive;
        }
        .Video_overlay-text h1 {
            font-size: 36px;
            margin: 0;
        }
        .Video_overlay-text p {
            font-size: 18px;
            margin-top: 10px;
        }
        .Video_overlay-text .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #FFD700;
            color: black;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .Video_overlay-text .btn:hover {
            background-color: #000;
            color: #fff;
        }
        .grid-sections {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin: 40px auto;
        padding: 0 20px;
        max-width: 1400px; /* Incrementar para cuadros más anchos */
    }

    .grid-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        cursor: pointer;
        height: 300px; /* Altura ajustada */
    }

    .grid-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .grid-item:hover img {
        transform: scale(1.1);
    }

    .grid-item h3 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 28px; /* Tamaño del texto */
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        margin: 0;
        text-align: center;
    }

    .grid-item:hover h3 {
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.9);
    }
    </style>
</head>
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

    <div class="Video_inicio">
        <video autoplay muted loop>
            <source src="Video_inicio.mp4" type="video/mp4">
        </video>
        <div class="Video_overlay-text">
            <h1>Bienvenido a Flex & Fuel</h1>
            <p>Encuentra tu fuerza interior y transforma tu cuerpo.</p>
            <a href="Registro.php" class="btn">Regístrate ahora</a>
        </div>
    </div>

    <div class="grid-sections">
        <a href="Accesorios.php" class="grid-item fade-in">
            <img src="accesorios.jpg" alt="Accesorios">
            <h3>Accesorios</h3>
        </a>
        <a href="Equipamiento.php" class="grid-item fade-in">
            <img src="equipamiento.jpg" alt="Equipamiento">
            <h3>Equipamiento</h3>
        </a>
        <a href="Ropa.php" class="grid-item fade-in">
            <img src="ropa.jpg" alt="Ropa">
            <h3>Ropa</h3>
        </a>
        <a href="Suplementacion.php" class="grid-item fade-in">
            <img src="suplementacion.jpg" alt="Suplementación">
            <h3>Suplementación</h3>
        </a>
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
