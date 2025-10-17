<?php
require_once '../MODELO/conexion.php';
require_once '../CONTROLADOR/Huespedes_logica.php';


$huespedLogic = new HuespedesLogica($conn);
$huespedes = $huespedLogic->obtenerHuespedes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Huéspedes</title>
    <link rel="stylesheet" href="../estilos.css">
      <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-image: url('https://images.neobookings.com/1920x1080/cms/hoteltorredelmar.com/section/piscina-infinity-exterior-en-forma-de-playa/pics/piscina-infinity-exterior-en-forma-de-playa-lem6rjr4gn.jpg'); 
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
        <div class="blanco"><h1> Huéspedes</h1></div>
        
        <a href="agregar_huesped.php" class="card">Agregar Huésped</a>
        <table>
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
            <?php if(!empty($huespedes)): ?>
                <?php foreach($huespedes as $h): ?>
                    <tr>
                        <td><?php echo $h['DOCUMENTO_IDENTIDAD']; ?></td>
                        <td><?php echo $h['NOMBRE']; ?></td>
                        <td><?php echo $h['EMAIL']; ?></td>
                        <td>
                            <a href="editar_huesped.php?doc=<?php echo $h['DOCUMENTO_IDENTIDAD']; ?>">Editar</a> |
                            <a href="eliminar_huesped.php?doc=<?php echo $h['DOCUMENTO_IDENTIDAD']; ?>" onclick="return confirm('¿Desea eliminar este huésped?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">No hay huéspedes registrados.</td></tr>
            <?php endif; ?>
        </table>
       
    </div>
</body>
</html>
