<?php
  // 1. Iniciar la sesión ANTES de cualquier HTML
  // Esto nos permite crear el "pase VIP"
  session_start(); 

  // 2. Incluir la conexión
  include 'conexion.php';

  // 3. Si el usuario YA tiene una sesión, no debe estar aquí.
  // Lo mandamos a la página principal.
  if (isset($_SESSION['usuario_id'])) {
      header("Location: PaginaPrincipal.php");
      exit;
  }

  // Variable para mostrar mensajes de error
  $mensaje_login = "";

  // 4. Revisar si el formulario fue enviado
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 5. Obtener y "limpiar" los datos del formulario
    $email = $conexion->real_escape_string($_POST['email']);
    $password_texto = $_POST['password']; // La contraseña que escribió el usuario

    // 6. Buscar al usuario en la base de datos por su email
    $sql = "SELECT * FROM Usuarios WHERE email = '$email'";
    $resultado = $conexion->query($sql);

    // 7. Verificar si el email existe (si encontró 1 fila)
    if ($resultado->num_rows == 1) {
        
        // El usuario sí existe, ahora verificamos la contraseña
        $usuario = $resultado->fetch_assoc();
        
        // 8. ¡LA PARTE MÁS IMPORTANTE!
        // Comparamos la contraseña de texto plano con el HASH de la BD
        if (password_verify($password_texto, $usuario['password_hash'])) {
            
            // ¡Contraseña Correcta!
            // 9. Guardamos los datos del usuario en su "pase VIP" (la sesión)
            $_SESSION['usuario_id'] = $usuario['usuario_id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre_completo'];

            // 10. Redirigimos a la página principal
            header("Location: PaginaPrincipal.php?login=exitoso");
            exit;

        } else {
            // Contraseña incorrecta
            $mensaje_login = "Error: La contraseña es incorrecta.";
        }
    } else {
        // El email no se encontró
        $mensaje_login = "Error: El correo electrónico '$email' no está registrado.";
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Flex & Fuel</title>
    <link rel="stylesheet" href="Estilo.css">
    
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; overflow: hidden; color: #FFD700; }
        #background-video { position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1; filter: blur(8px); }
        .registro-container { background-color: rgba(0, 0, 0, 0.6); border-radius: 10px; padding: 20px; width: 400px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); text-align: center; }
        .registro-container h1 { margin-bottom: 20px; color: #FFD700; font-weight: bold; font-size: 1.8em; }
        .registro-container form input { width: calc(100% - 2px); padding: 10px; margin: 10px 0; border: 1px solid #FFD700; border-radius: 5px; background-color: #000; color: #FFD700; font-size: 1em; box-sizing: border-box; transition: border-color 0.3s ease; }
        .registro-container form input::placeholder { color: #FFD700; opacity: 0.8; }
        .registro-container form input:hover { border-color: #FFC800; }
        .registro-container form button { background-color: #FFD700; color: #000; border: none; padding: 10px; cursor: pointer; border-radius: 5px; font-weight: bold; width: 100%; margin-bottom: 15px; transition: background-color 0.3s ease, color 0.3s ease; }
        .registro-container form button:hover { background-color: #000; color: #FFD700; }
        .btn-regresar { display: inline-block; background-color: #000; color: #FFD700; border: 1px solid #FFD700; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background-color 0.3s ease, color 0.3s ease; }
        .btn-regresar:hover { background-color: #FFD700; color: #000; }
        .mensaje-error { color: #E74C3C; background-color: rgba(255, 0, 0, 0.1); border: 1px solid #E74C3C; padding: 10px; border-radius: 5px; margin-top: 15px; }
    </style>
</head>
<body>
 
    <video id="background-video" autoplay muted loop>
        <source src="tren-twins.mp4" type="video/mp4">
        Tu navegador no soporta la reproducción de videos.
    </video>

    <div class="registro-container">
        <h1>Iniciar Sesión</h1>

        <form action="login.php" method="POST"> 
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>

        <?php if (!empty($mensaje_login)): ?>
            <div class="mensaje-error">
                <?php echo $mensaje_login; ?>
            </div>
        <?php endif; ?>

        <a href="PaginaPrincipal.php" class="btn-regresar">Regresar a la página principal</a>
    </div>
    
    <script src="main.js"></script>
</body>
</html>