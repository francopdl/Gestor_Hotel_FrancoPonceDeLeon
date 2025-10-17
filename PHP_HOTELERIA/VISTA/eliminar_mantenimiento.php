<?php
require_once __DIR__ . '/../MODELO/conexion.php';
require_once __DIR__ . '/../CONTROLADOR/Mantenimiento_logica.php';

$mantenimientoLogic = new MantenimientosLogica($conn);
$id = $_GET['id'] ?? null;

if ($id) {
    $mantenimientoLogic->eliminarMantenimiento($id);
}

header("Location: mantenimiento.php");
exit;
?>
