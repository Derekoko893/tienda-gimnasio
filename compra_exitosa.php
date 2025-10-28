<?php
// 1. Iniciar sesión y conexión
session_start();
include 'conexion.php';

// 2. Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// 3. Verificar si nos pasaron un ID de pedido
if (!isset($_GET['id'])) {
    // Si no hay ID, lo mandamos a la página principal
    header("Location: PaginaPrincipal.php?error=nop_id");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$pedido_id = (int)$_GET['id'];

// 4. Verificar que el pedido sea REAL y pertenezca a ESTE usuario (Seguridad)
$sql = "SELECT * FROM Pedidos WHERE pedido_id = $pedido_id AND usuario_id = $usuario_id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows != 1) {
    // El pedido no existe o no es de este usuario
    header("Location: PaginaPrincipal.php?error=invalid_order");
    exit;
}

// Si llegamos aquí, todo está en orden.
$pedido = $resultado->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <title>¡Compra Exitosa! - Flex & Fuel</title>
    <style>
        body { background-color: #f5f5f5; }
        .contenedor-exito {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 { font-family: 'Pacifico', cursive; color: #000; }
        p { font-size: 18px; line-height: 1.6; }
        h2 { font-size: 24px; color: #333; }
        .boton-recibo {
            display: inline-block;
            padding: 12px 25px;
            background-color: #FFD700;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        .boton-recibo:hover { background-color: #000; color: #FFD700; }
        .boton-volver {
            display: inline-block;
            padding: 12px 25px;
            background-color: #555;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            margin-top: 20px;
            margin-left: 10px;
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

    <div class="contenedor-exito">
        <h1>¡Gracias por tu compra, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>!</h1>
        <p>Tu pedido ha sido procesado con éxito.</p>
        <p>Tu número de pedido es:</p>
        <h2>Pedido #<?php echo $pedido['pedido_id']; ?></h2>
        
        <p>Total de la compra: <strong>$<?php echo number_format($pedido['total'], 2); ?></strong></p>

        <a href="generar_recibo.php?id=<?php echo $pedido['pedido_id']; ?>" class="boton-recibo" target="_blank">
            Descargar Recibo (PDF)
        </a>
        
        <a href="PaginaPrincipal.php" class="boton-volver">
            Seguir Comprando
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Limpiamos el localStorage para que el carrito vuelva a 0
            localStorage.removeItem('carrito');
            console.log("Carrito limpiado después de la compra.");
        });
    </script>

</body>
</html>