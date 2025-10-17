<?php
require_once '../MODELO/conexion.php';
require_once '../CONTROLADOR/Huespedes_logica.php';

$huespedLogic = new HuespedesLogica($conn);
$doc = $_GET['doc'] ?? null;

if (!$doc) {
    header("Location: huespedes.php");
    exit;
}

$h = $huespedLogic->obtenerHuesped($doc);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    if ($huespedLogic->actualizarHuesped($doc, $nombre, $email)) {
        header("Location: huespedes.php");
        exit;
    } else {
        $error = "Error al actualizar el huésped.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Huésped</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <div class="container">
        <h1>✏️ Editar Huésped</h1>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $h['NOMBRE']; ?>" required><br><br>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $h['EMAIL']; ?>" required><br><br>
            <button type="submit">Actualizar</button>
        </form>
        
    </div>
</body>
</html>
