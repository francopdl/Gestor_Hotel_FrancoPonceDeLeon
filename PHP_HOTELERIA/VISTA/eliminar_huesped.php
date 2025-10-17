<?php
require_once '../MODELO/conexion.php';
require_once '../CONTROLADOR/Huespedes_logica.php';

$huespedLogic = new HuespedesLogica($conn);
$doc = $_GET['doc'] ?? null;

if ($doc) {
    $huespedLogic->eliminarHuesped($doc);
}

header("Location: huespedes.php");
exit;
?>
