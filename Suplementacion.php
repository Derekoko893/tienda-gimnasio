<?php session_start(); ?>
<?php include 'conexion.php'; 
  // 2. Lógica para el formulario de suscripción (para el footer)
  $mensaje_suscripcion = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email_suscripcion = $conexion->real_escape_string($_POST['email']);
    $sql = "INSERT IGNORE INTO Suscripciones (email) VALUES ('$email_suscripcion')";
    if ($conexion->query($sql)) {
      $mensaje_suscripcion = ($conexion->affected_rows > 0) ? "¡Gracias por suscribirte!" : "Ese correo ya estaba registrado.";
    } else {
      $mensaje_suscripcion = "Error al registrar el correo.";
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="Estilo.css">
    <title>Suplementación - Flex & Fuel</title>
    <style>
        /* Estilos CSS (copiados de accesorios.php) */
        .container { display: flex; padding: 20px; }
        .sidebar { width: 200px; background-color: #000; color: #fff; padding: 10px; border-radius: 5px; position: relative; }
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
    <div class="mensaje-carrito" id="mensaje-carrito">Producto añadido al carrito</div>
    
    <div class="container">
        <aside class="sidebar">
            <h2>Categorías</h2>
            <a href="#suplementos">Todos</a>
            <div class="divider"></div>
        </aside>
        <main class="content">
            <h1>Suplementación</h1>
            <p>Bienvenido a la sección de suplementación. Encuentra lo que necesitas para alcanzar tus metas.</p>

            <section id="suplementos" class="fade-in-scale">
                <h2>Todos los Suplementos</h2>
                <div class="productos-container">
                    <?php
                    // Esta consulta busca TODOS los productos en la categoría 'Suplementación'
                    $sql = "SELECT * FROM Productos WHERE categoria = 'Suplementación'";
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
                        }
                    } else { 
                        // Mensaje si aún no has añadido suplementos a la BD
                        echo "<p>Aún no hay productos de suplementación disponibles.</p>"; 
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
            
            <?php if (!empty($mensaje_suscripcion)): ?>
              <p style="color: #FFD700; margin-top: 15px;">
                <?php echo $mensaje_suscripcion; ?>
              </p>
            <?php endif; ?>
        </div>
    </footer> 

    <script src="main.js"></script>
</body>
</html>