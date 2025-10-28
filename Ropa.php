<?php session_start(); ?>
<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="Estilo.css">
    <title>Ropa - Flex & Fuel</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 70px); 
        }
        .section {
            width: 400px;  
            height: 400px; 
            border-radius: 10px;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            cursor: pointer;
            margin: 20px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .section:hover {
            transform: scale(1.05); 
        }
        .section h2 {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 28px;  
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .hombres {
            background-color: rgba(0, 0, 0, 0.6);
            /* Ruta original mantenida */
            background-image: url('cbum.png'); 
            background-size: cover;
            background-position: center;
        }
        .mujeres {
            background-color: rgba(0, 0, 0, 0.6);
            /* Ruta original mantenida */
            background-image: url('mujer.png'); 
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
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
        <div class="section hombres" onclick="window.location='hombres.php'"> 
            <h2>Hombres</h2>
        </div>
        <div class="section mujeres" onclick="window.location='mujeres.php'"> 
            <h2>Mujeres</h2>
        </div>
    </div>
    
    <script src="main.js"></script>
</body>
</html>