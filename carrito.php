<?php session_start(); ?>
<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Estilo.css">
    <script src="main.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <title>Carrito - Flex & Fuel</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #000000;
        }
        header img {
            width: 150px; 
        }
        nav {
            display: flex;
            gap: 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
        }
        .icono-carrito img {
            width: 30px;
            height: 30px;
        }
        .contenedor-carrito {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .carrito {
            width: 80%;
            max-width: 1200px;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #000;
            font-family: 'Pacifico', cursive;
        }
        .tabla-carrito {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .tabla-carrito th, .tabla-carrito td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .tabla-carrito th {
            background-color: #000;
            color: #fff;
        }
        .tabla-carrito td {
            background-color: #f9f9f9;
        }
        .total-carrito {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }
        .boton-finalizar {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #FFD700;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .boton-finalizar:hover {
            background-color: #000;
            color: #FFD700;
        }
         .btn-eliminar {
            background-color: #c0392b;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-eliminar:hover {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <header>
        <a href="PaginaPrincipal.php">
            <img src="LOGO CON LETRAS.PNG" alt="Logo">
        </a>
        <nav>
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
            <img src="carrito-icono.png" alt="Carrito">
        </a>
    </header>
    
    <div class="contenedor-carrito">
        <form id="form-carrito" action="finalizar_compra.php" method="POST">
            <div class="carrito">
                <h1>Tu Carrito</h1>
                <table class="tabla-carrito">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="carrito-items">
                      </tbody>
                </table>
                <div class="total-carrito" id="total-carrito">
                    Total: $0.00
                </div>
                
                <button type="submit" class="boton-finalizar">Finalizar Compra</button>
            </div>
        </form>
    </div>
</body>
</html>