<?php
require_once __DIR__ . '/../MODELO/conexion.php';
require_once __DIR__ . '/../CONTROLADOR/Mantenimiento_logica.php';
require_once __DIR__ . '/../CONTROLADOR/Habitaciones_logica.php';

$mantenimientoLogic = new MantenimientosLogica($conn);
$habitacionLogic = new HabitacionesLogica($conn);
$habitaciones = $habitacionLogic->obtenerHabitaciones();

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: mantenimiento.php");
    exit;
}

$m = $mantenimientoLogic->obtenerMantenimiento($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero_h = $_POST['numero_h'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin_esperada = $_POST['fecha_fin_esperada'];
    $estado = $_POST['estado'];

    if ($mantenimientoLogic->actualizarMantenimiento($id, $numero_h, $descripcion, $fecha_inicio, $fecha_fin_esperada, $estado)) {
        header("Location: mantenimiento.php");
        exit;
    } else {
        $error = "Error al actualizar el mantenimiento.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Mantenimiento</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
<div class="container">
    <h1>✏️ Editar Mantenimiento</h1>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Habitación:</label>
        <select name="numero_h" required>
            <?php foreach($habitaciones as $h): ?>
                <option value="<?php echo $h['NUMERO_H']; ?>" <?php if($h['NUMERO_H']==$m['NUMERO_H']) echo 'selected'; ?>>
                    #<?php echo $h['NUMERO_H'].' - '.$h['TIPO']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Descripción:</label>
        <input type="text" name="descripcion" value="<?php echo $m['DESCRIPCION']; ?>" required><br><br>

        <label>Fecha Inicio:</label>
        <input type="date" name="fecha_inicio" value="<?php echo $m['FECHA_INICIO']; ?>" required><br><br>

        <label>Fecha Fin Esperada:</label>
        <input type="date" name="fecha_fin_esperada" value="<?php echo $m['FECHA_FIN_ESPERADA']; ?>" required><br><br>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="Activo" <?php if($m['ESTADO']=='Activo') echo 'selected'; ?>>Activo</option>
            <option value="Completado" <?php if($m['ESTADO']=='Completado') echo 'selected'; ?>>Completado</option>
            <option value="Cancelado" <?php if($m['ESTADO']=='Cancelado') echo 'selected'; ?>>Cancelado</option>
        </select><br><br>

        <button type="submit">Actualizar</button>
    </form>
    <a href="mantenimiento.php" class="volver">⬅ Volver</a>
</div>
</body>
</html>
