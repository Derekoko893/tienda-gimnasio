<?php session_start(); ?>
<?php include 'conexion.php'; 
  // Variable para mostrar mensajes al usuario
  $mensaje_registro = "";

  // 2. Revisamos si el formulario fue enviado (si se usó el método POST)
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. Obtenemos y "limpiamos" los datos del formulario
    // real_escape_string previene inyecciones SQL
    $nombre = $conexion->real_escape_string($_POST['nombre_completo']);
    $pais = $conexion->real_escape_string($_POST['pais']);
    $fecha_nacimiento = $conexion->real_escape_string($_POST['fecha_nacimiento']);
    $email = $conexion->real_escape_string($_POST['email']);
    $password_texto = $_POST['password']; // Obtenemos la contraseña en texto plano

    // 4. HASHEAR la contraseña (¡NUNCA GUARDAR CONTRASEÑAS EN TEXTO PLANO!)
    // Esto la convierte en un código largo e irreversible
    $password_hash = password_hash($password_texto, PASSWORD_DEFAULT);

    // 5. Preparamos la consulta SQL
    // Usamos INSERT IGNORE para que no falle si el email ya está duplicado
    $sql = "INSERT IGNORE INTO Usuarios (nombre_completo, pais, fecha_nacimiento, email, password_hash) 
            VALUES ('$nombre', '$pais', '$fecha_nacimiento', '$email', '$password_hash')";

    // 6. Ejecutamos la consulta
    if ($conexion->query($sql)) {
        // 'affected_rows' nos dice si la fila fue realmente insertada
        if ($conexion->affected_rows > 0) {
            // ¡Éxito! Redirigimos al inicio
            // 'header' es una función de PHP que envía al usuario a otra página
            header("Location: PaginaPrincipal.php?registro=exitoso");
            exit; // Detenemos el script
        } else {
            // Esto significa que el email ya existía (porque usamos INSERT IGNORE)
            $mensaje_registro = "Error: El correo electrónico '$email' ya está registrado.";
        }
    } else {
        // Hubo un error en la consulta SQL
        $mensaje_registro = "Error al registrar el usuario: " . $conexion->error;
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Flex & Fuel</title>
    <link rel="stylesheet" href="Estilo.css">
    
    <style>
        /* Estilos CSS (sin cambios) */
        body { margin: 0; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; overflow: hidden; color: #FFD700; }
        #background-video { position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1; filter: blur(8px); }
        .registro-container { background-color: rgba(0, 0, 0, 0.6); border-radius: 10px; padding: 20px; width: 400px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); text-align: center; }
        .registro-container h1 { margin-bottom: 20px; color: #FFD700; font-weight: bold; font-size: 1.8em; }
        .registro-container form input,
        .registro-container form select { width: calc(100% - 2px); padding: 10px; margin: 10px 0; border: 1px solid #FFD700; border-radius: 5px; background-color: #000; color: #FFD700; font-size: 1em; box-sizing: border-box; transition: border-color 0.3s ease; }
        .registro-container form input::placeholder { color: #FFD700; opacity: 0.8; }
        .registro-container form input:hover,
        .registro-container form select:hover { border-color: #FFC800; }
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
        <h1>Registrarme</h1>

        <form action="registro.php" method="POST"> 
            <input type="text" name="nombre_completo" placeholder="Nombre completo" required>
            <select name="pais" required>
                <option value="" disabled selected>Selecciona tu país</option>
                <option value="Argentina">Argentina</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Brasil">Brasil</option>
                <option value="Canadá">Canadá</option>
                <option value="Chile">Chile</option>
                <option value="Colombia">Colombia</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cuba">Cuba</option>
                <option value="Ecuador">Ecuador</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Estados Unidos">Estados Unidos</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Honduras">Honduras</option>
                <option value="México">México</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Panamá">Panamá</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Perú">Perú</option>
                <option value="República Dominicana">República Dominicana</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Venezuela">Venezuela</option>
            </select>
            <input type="date" name="fecha_nacimiento" placeholder="Fecha de nacimiento" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Enviar</button>
        </form>

        <?php if (!empty($mensaje_registro)): ?>
            <div class="mensaje-error">
                <?php echo $mensaje_registro; ?>
            </div>
        <?php endif; ?>

        <a href="PaginaPrincipal.php" class="btn-regresar">Regresar a la página principal</a>
    </div>
    
    <script src="main.js"></script>
</body>
</html>