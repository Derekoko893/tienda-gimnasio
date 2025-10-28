<?php
// 1. Iniciar la sesión ANTES de todo
session_start();

// 2. Incluir la conexión
include 'conexion.php';

// 3. Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?origen=carrito");
    exit;
}

// 4. Verificar si se enviaron datos del carrito
if (!isset($_POST['cart_data_json']) || empty($_POST['cart_data_json'])) {
    header("Location: carrito.php?error=nodata");
    exit;
}

// 5. Decodificar los datos del carrito
$carrito = json_decode($_POST['cart_data_json'], true);

if (empty($carrito)) {
    header("Location: carrito.php?error=empty");
    exit;
}

// --- TODO BIEN, PROCEDEMOS A GUARDAR LA COMPRA ---

$usuario_id = $_SESSION['usuario_id'];
$total_pedido = 0;
$productos_con_id = [];

// 6. Validar carrito y calcular total
try {
    foreach ($carrito as $item) {
        $nombre = $conexion->real_escape_string($item['nombre']);
        $cantidad = (int)$item['cantidad'];
        
        $sql_prod = "SELECT producto_id, precio FROM Productos WHERE nombre = '$nombre'";
        $res_prod = $conexion->query($sql_prod);

        if ($res_prod->num_rows == 1) {
            $producto_db = $res_prod->fetch_assoc();
            $precio_unitario_db = (float)$producto_db['precio'];
            
            $total_pedido += $precio_unitario_db * $cantidad;
            
            $productos_con_id[] = [
                'producto_id' => $producto_db['producto_id'],
                'cantidad' => $cantidad,
                'precio_unitario' => $precio_unitario_db
            ];

        } else {
            throw new Exception("El producto '$nombre' no se encontró.");
        }
    }
} catch (Exception $e) {
    header("Location: carrito.php?error=" . urlencode($e->getMessage()));
    exit;
}

// 7. Iniciar Transacción
$conexion->begin_transaction();

try {
    // 8. Insertar en la tabla 'Pedidos'
    $sql_pedido = "INSERT INTO Pedidos (usuario_id, total, estado) 
                   VALUES ($usuario_id, $total_pedido, 'Procesando')";
    
    if (!$conexion->query($sql_pedido)) {
        throw new Exception("Error al crear el pedido: " . $conexion->error);
    }

    // 9. Obtener el ID del pedido que acabamos de crear
    $nuevo_pedido_id = $conexion->insert_id;

    if (empty($nuevo_pedido_id) || $nuevo_pedido_id == 0) {
        throw new Exception("No se pudo obtener el ID del nuevo pedido. La transacción falló.");
    }

    // 10. Insertar cada producto en 'DetallePedido'
    foreach ($productos_con_id as $prod) {
        $producto_id = $prod['producto_id'];
        $cantidad = $prod['cantidad'];
        $precio_unitario = $prod['precio_unitario'];

        $sql_detalle = "INSERT INTO DetallePedido (pedido_id, producto_id, cantidad, precio_unitario)
                        VALUES ($nuevo_pedido_id, $producto_id, $cantidad, $precio_unitario)";
        
        if (!$conexion->query($sql_detalle)) {
            throw new Exception("Error al guardar detalles del pedido: " . $conexion->error);
        }
    }

    // 11. Si todo salió bien, confirmamos los cambios
    $conexion->commit();

    // 12. Redirigimos a la página de éxito
    header("Location: compra_exitosa.php?id=" . $nuevo_pedido_id);
    exit;

} catch (Exception $e) {
    // 13. Si algo falló, deshacemos todos los cambios
    $conexion->rollback();
    
    // Regresamos al carrito con el error
    header("Location: carrito.php?error=" . urlencode($e->getMessage()));
    exit;
}
?>