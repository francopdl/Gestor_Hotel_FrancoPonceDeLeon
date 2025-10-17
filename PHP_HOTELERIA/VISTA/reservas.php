<?php
require_once '../MODELO/conexion.php';
require_once '../CONTROLADOR/Reserva_logica.php';

$reservaLogic = new ReservasLogica($conn);
$reservas = $reservaLogic->obtenerReservas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservas</title>
    <link rel="stylesheet" href="../estilos.css">

      <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-image: url('https://www.servigroup.com/assets/cache/uploads/hoteles/galua/exterior/1850x667/01-la-manga-del-mar-menor-hotel-galua-aerea-11-1750769791.jpg'); 
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
    <div class="blanco"><h1> Reservas</h1></div>
    
    <a href="agregar_reserva.php" class="card">Agregar Reserva</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Huésped</th>
            <th>Habitación</th>
            <th>Fecha Reserva</th>
            <th>Llegada</th>
            <th>Salida</th>
            <th>Precio Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php if(!empty($reservas)): ?>
            <?php foreach($reservas as $r): ?>
                <tr>
                    <td><?php echo $r['ID_RESERVA']; ?></td>
                    <td><?php echo $r['DOCUMENTO_IDENTIDAD']; ?></td>
                    <td><?php echo $r['NUMERO_H']; ?></td>
                    <td><?php echo $r['FECHA_RESERVA']; ?></td>
                    <td><?php echo $r['FECHA_LLEGADA']; ?></td>
                    <td><?php echo $r['FECHA_SALIDA']; ?></td>
                    <td><?php echo $r['PRECIO_TOTAL']; ?></td>
                    <td><?php echo $r['ESTADO']; ?></td>
                    <td>
                        <a href="editar_reserva.php?id=<?php echo $r['ID_RESERVA']; ?>">Editar</a> |
                        <a href="eliminar_reserva.php?id=<?php echo $r['ID_RESERVA']; ?>" onclick="return confirm('¿Desea eliminar esta reserva?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="9">No hay reservas registradas.</td></tr>
        <?php endif; ?>
    </table>
    
</div>
</body>
</html>
