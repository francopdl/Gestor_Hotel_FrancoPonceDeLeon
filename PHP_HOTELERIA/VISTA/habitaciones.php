<?php
require_once '../MODELO/conexion.php';
require_once '../CONTROLADOR/Habitaciones_logica.php';

$habitacionLogic = new HabitacionesLogica($conn);
$habitaciones = $habitacionLogic->obtenerHabitaciones();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Habitaciones</title>
    <link rel="stylesheet" href="../estilos.css">


    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-image: url('https://wallpapers.com/images/hd/hotel-room-1920-x-1080-background-njycrrj161g2xcia.jpg'); 
            background-size: cover;       
            background-position: center;  
            background-repeat: no-repeat;
            background-attachment: fixed; 
            color: white;
        }
</style>
</head>
<body>
    <div class="container">
        <div class= "blanco"><h1> Habitaciones</h1></div>
        
        <a href="agregar_habitacion.php" class="card">Agregar Nueva Habitación</a>

        <table>
            <tr>
                <th>Número</th>
                <th>Tipo</th>
                <th>Precio Base</th>
                <th>Estado Limpieza</th>
                <th>Acciones</th>
            </tr>
            <?php if (!empty($habitaciones)): ?>
                <?php foreach ($habitaciones as $hab): ?>
                    <tr>
                        <td><?php echo $hab['NUMERO_H']; ?></td>
                        <td><?php echo $hab['TIPO']; ?></td>
                        <td><?php echo $hab['PRECIO_BASE']; ?></td>
                        <td><?php echo $hab['ESTADO_LIMPIEZA']; ?></td>
                        <td>
                            <a href="editar_habitacion.php?numero=<?php echo $hab['NUMERO_H']; ?>">Editar</a> |
                            <a href="eliminar_habitacion.php?numero=<?php echo $hab['NUMERO_H']; ?>" onclick="return confirm('¿Desea eliminar esta habitación?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No hay habitaciones registradas.</td></tr>
            <?php endif; ?>
        </table>

        
    </div>
</body>
</html>
