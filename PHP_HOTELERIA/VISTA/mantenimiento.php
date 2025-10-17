<?php
require_once __DIR__ . '/../MODELO/conexion.php';
require_once __DIR__ . '/../CONTROLADOR/Mantenimiento_logica.php';
require_once __DIR__ . '/../CONTROLADOR/Habitaciones_logica.php';

$mantenimientoLogic = new MantenimientosLogica($conn);
$habitacionLogic = new HabitacionesLogica($conn);

$mantenimientos = $mantenimientoLogic->obtenerMantenimientos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mantenimientos</title>
    <link rel="stylesheet" href="../estilos.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-image: url('https://static.hosteltur.com/app/public/uploads/img/articles/2024/11/27/L_151605_tareas-de-mantenimiento-de-un-hotel-cuales-son-y-como-mejorarlas.jpg'); 
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
    <h1> Mantenimientos</h1>
    <a href="agregar_mantenimiento.php" class="card">Agregar Mantenimiento</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Habitación</th>
            <th>Descripción</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin Esperada</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php if(!empty($mantenimientos)): ?>
            <?php foreach($mantenimientos as $m): 
                $habitacion = $habitacionLogic->obtenerHabitacion($m['NUMERO_H']);
            ?>
                <tr>
                    <td><?php echo $m['ID_MANTENIMIENTO']; ?></td>
                    <td>#<?php echo $m['NUMERO_H']; ?> - <?php echo $habitacion['TIPO'] ?? ''; ?></td>
                    <td><?php echo $m['DESCRIPCION']; ?></td>
                    <td><?php echo $m['FECHA_INICIO']; ?></td>
                    <td><?php echo $m['FECHA_FIN_ESPERADA']; ?></td>
                    <td><?php echo $m['ESTADO']; ?></td>
                    <td>
                        <a href="editar_mantenimiento.php?id=<?php echo $m['ID_MANTENIMIENTO']; ?>">Editar</a> |
                        <a href="eliminar_mantenimiento.php?id=<?php echo $m['ID_MANTENIMIENTO']; ?>" onclick="return confirm('¿Desea eliminar este mantenimiento?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No hay mantenimientos registrados.</td></tr>
        <?php endif; ?>
    </table>
    
</div>
</body>
</html>
