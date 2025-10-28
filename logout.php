<?php
  // 1. Inicia la sesión (para poder acceder a ella)
  session_start();

  // 2. Destruye todas las variables de sesión
  session_unset();

  // 3. Destruye la sesión por completo
  session_destroy();

  // 4. Redirige al usuario a la página principal
  header("Location: PaginaPrincipal.php?logout=exitoso");
  exit;
?>