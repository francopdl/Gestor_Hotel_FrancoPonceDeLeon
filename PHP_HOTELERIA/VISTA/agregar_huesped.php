<?php
require_once '../MODELO/conexion.php';
require_once '../CONTROLADOR/Huespedes_logica.php';

$huespedLogic = new HuespedesLogica($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    if ($huespedLogic->crearHuesped($documento, $nombre, $email)) {
        header("Location: huespedes.php");
        exit;
    } else {
        $error = "Error al agregar el huésped.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Huésped</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <div class="container">
        <h1>➕ Agregar Huésped</h1>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <label>Documento:</label>
            <input type="text" name="documento" required><br><br>
            <label>Nombre:</label>
            <input type="text" name="nombre" required><br><br>
            <label>Email:</label>
            <input type="email" name="email" required><br><br>
            <button type="submit">Agregar</button>
        </form>
        
    </div>
</body>
</html>
