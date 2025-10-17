<?php
require_once '../MODELO/conexion.php';
require_once '../CONTROLADOR/Habitaciones_logica.php';

$habitacionLogic = new HabitacionesLogica($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];

    if ($habitacionLogic->crearHabitacion($tipo, $precio, $estado)) {
        header("Location: habitaciones.php");
        exit;
    } else {
        $error = "Error al agregar la habitación.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Habitación</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <div class="container">
        <h1>➕ Agregar Habitación</h1>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="" method="POST">
            <label>Tipo:</label>
            <select name="tipo" required>
                <option value="Sencilla">Sencilla</option>
                <option value="Doble">Doble</option>
                <option value="Suite">Suite</option>
            </select><br><br>

            <label>Precio Base:</label>
            <input type="number" step="0.01" name="precio" required><br><br>

            <label>Estado de Limpieza:</label>
            <select name="estado" required>
                <option value="Limpia">Limpia</option>
                <option value="Sucia">Sucia</option>
                <option value="En Limpieza">En Limpieza</option>
            </select><br><br>

            <button type="submit">Agregar</button>
        </form>

        
    </div>
</body>
</html>
