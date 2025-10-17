<?php
require_once '../MODELO/conexion.php';
require_once '../CONTROLADOR/Habitaciones_logica.php';

$habitacionLogic = new HabitacionesLogica($conn);
$numero = $_GET['numero'] ?? null;

if ($numero) {
    $habitacionLogic->eliminarHabitacion($numero);
}

header("Location: habitaciones.php");
exit;
?>
