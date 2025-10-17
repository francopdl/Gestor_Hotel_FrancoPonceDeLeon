<?php
require_once '../MODELO/conexion.php';
require_once '../CONTROLADOR/Reserva_logica.php';
require_once '../CONTROLADOR/Huespedes_logica.php';
require_once '../CONTROLADOR/Habitaciones_logica.php';

$reservaLogic = new ReservasLogica($conn);
$huespedLogic = new HuespedesLogica($conn);
$habitacionLogic = new HabitacionesLogica($conn);

$huespedes = $huespedLogic->obtenerHuespedes();
$habitaciones = $habitacionLogic->obtenerHabitaciones();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $documento = $_POST['documento'];
    $numero_h = $_POST['numero_h'];
    $fecha_llegada = $_POST['fecha_llegada'];
    $fecha_salida = $_POST['fecha_salida'];
    $precio_total = $_POST['precio_total'];
    $estado = $_POST['estado'];

    if ($reservaLogic->crearReserva($documento, $numero_h, $fecha_llegada, $fecha_salida, $precio_total, $estado)) {
        header("Location: reservas.php");
        exit;
    } else {
        $error = "Error al agregar la reserva.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Reserva</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
<div class="container">
    <h1>➕ Agregar Reserva</h1>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Huésped:</label>
        <select name="documento" required>
            <?php foreach($huespedes as $h): ?>
                <option value="<?php echo $h['DOCUMENTO_IDENTIDAD']; ?>"><?php echo $h['NOMBRE']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Habitación:</label>
        <select name="numero_h" required>
            <?php foreach($habitaciones as $hab): ?>
                <option value="<?php echo $hab['NUMERO_H']; ?>">#<?php echo $hab['NUMERO_H'].' - '.$hab['TIPO']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Fecha Llegada:</label>
        <input type="date" name="fecha_llegada" required><br><br>

        <label>Fecha Salida:</label>
        <input type="date" name="fecha_salida" required><br><br>

        <label>Precio Total:</label>
        <input type="number" step="0.01" name="precio_total" required><br><br>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="Pendiente">Pendiente</option>
            <option value="Confirmada">Confirmada</option>
            <option value="Cancelada">Cancelada</option>
        </select><br><br>

        <button type="submit">Agregar</button>
    </form>
    
</div>
</body>
</html>
