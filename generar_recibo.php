<?php
// 1. Iniciar sesión y conexión
session_start();
include 'conexion.php';

// 2. Incluir la biblioteca FPDF
require('fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta

// 3. Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    die("Error: Debes iniciar sesión para ver este recibo.");
}

// 4. Verificar si nos pasaron un ID de pedido
if (!isset($_GET['id'])) {
    die("Error: No se especificó un número de pedido.");
}

$usuario_id = $_SESSION['usuario_id'];
$pedido_id = (int)$_GET['id'];

// 5. Verificar que el pedido sea REAL y pertenezca a ESTE usuario (Seguridad)
$sql_pedido = "SELECT p.*, u.nombre_completo, u.email 
               FROM Pedidos p
               JOIN Usuarios u ON p.usuario_id = u.usuario_id
               WHERE p.pedido_id = $pedido_id AND p.usuario_id = $usuario_id";
               
$res_pedido = $conexion->query($sql_pedido);

if ($res_pedido->num_rows != 1) {
    die("Error: Pedido no válido o no te pertenece.");
}

// Si llegamos aquí, todo está en orden.
$pedido = $res_pedido->fetch_assoc();


// 6. ---- ¡AQUÍ EMPIEZA LA MAGIA DE FPDF! ----

// Creamos un nuevo objeto PDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo (Asegúrate de que esta imagen exista)
        $this->Image('LOGO CON LETRAS.PNG', 10, 8, 33);
        // Fuente
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, 'Recibo de Compra', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Fuente
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// 7. Crear el documento PDF
$pdf = new PDF();
$pdf->AliasNbPages(); // Habilita el conteo de páginas
$pdf->AddPage(); // Añade la primera página
$pdf->SetFont('Arial', '', 12); // Establece la fuente

// 8. Información del Cliente y Pedido
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Cliente:', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 10, utf8_decode($pedido['nombre_completo']), 0, 1); // utf8_decode para acentos

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Email:', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 10, $pedido['email'], 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Numero de Pedido:', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 10, $pedido['pedido_id'], 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Fecha:', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 10, date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])), 0, 1);

$pdf->Ln(10); // Un salto de línea

// 9. Crear la Tabla de Productos
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(230, 230, 230); // Color de fondo gris claro
$pdf->Cell(95, 10, 'Producto', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'P. Unitario', 1, 0, 'C', true);
$pdf->Cell(35, 10, 'Subtotal', 1, 1, 'C', true);

// 10. Buscar los productos del pedido en 'DetallePedido'
$sql_detalles = "SELECT d.*, p.nombre 
                 FROM DetallePedido d
                 JOIN Productos p ON d.producto_id = p.producto_id
                 WHERE d.pedido_id = $pedido_id";

$res_detalles = $conexion->query($sql_detalles);

$pdf->SetFont('Arial', '', 12);
while ($detalle = $res_detalles->fetch_assoc()) {
    $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
    
    $pdf->Cell(95, 10, utf8_decode($detalle['nombre']), 1, 0, 'L');
    $pdf->Cell(30, 10, $detalle['cantidad'], 1, 0, 'C');
    $pdf->Cell(30, 10, '$' . number_format($detalle['precio_unitario'], 2), 1, 0, 'R');
    $pdf->Cell(35, 10, '$' . number_format($subtotal, 2), 1, 1, 'R');
}

// 11. Mostrar el TOTAL
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(155, 10, 'TOTAL:', 0, 0, 'R');
$pdf->Cell(35, 10, '$' . number_format($pedido['total'], 2), 1, 1, 'R');


// 12. Generar el PDF
$pdf->Output('I', 'Recibo_FlexFuel_#' . $pedido_id . '.pdf');
// 'I' significa "Inline" (mostrar en el navegador)
// 'D' significaría "Download" (forzar descarga)
?>