<?php
require_once '../MODELO/conexion.php';
require_once '../CONTROLADOR/Habitaciones_logica.php';

$habitacionLogic = new HabitacionesLogica($conn);

$numero = $_GET['numero'] ?? null;
if (!$numero) {
    header("Location: habitaciones.php");
    exit;
}

$hab = $habitacionLogic->obtenerHabitacion($numero);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];

    if ($habitacionLogic->actualizarHabitacion($numero, $tipo, $precio, $estado)) {
        header("Location: habitaciones.php");
        exit;
    } else {
        $error = "Error al actualizar la habitación.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Habitación</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <div class="container">
        <h1>✏️ Editar Habitación</h1>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="" method="POST">
            <label>Tipo:</label>
            <select name="tipo" required>
                <option value="Sencilla" <?php if($hab['TIPO']=='Sencilla') echo 'selected'; ?>>Sencilla</option>
                <option value="Doble" <?php if($hab['TIPO']=='Doble') echo 'selected'; ?>>Doble</option>
                <option value="Suite" <?php if($hab['TIPO']=='Suite') echo 'selected'; ?>>Suite</option>
            </select><br><br>

            <label>Precio Base:</label>
            <input type="number" step="0.01" name="precio" value="<?php echo $hab['PRECIO_BASE']; ?>" required><br><br>

            <label>Estado de Limpieza:</label>
            <select name="estado" required>
                <option value="Limpia" <?php if($hab['ESTADO_LIMPIEZA']=='Limpia') echo 'selected'; ?>>Limpia</option>
                <option value="Sucia" <?php if($hab['ESTADO_LIMPIEZA']=='Sucia') echo 'selected'; ?>>Sucia</option>
                <option value="En Limpieza" <?php if($hab['ESTADO_LIMPIEZA']=='En Limpieza') echo 'selected'; ?>>En Limpieza</option>
            </select><br><br>

            <button type="submit">Actualizar</button>
        </form>

        <a href="habitaciones.php" class="volver">⬅ Volver</a>
    </div>
</body>
</html>
