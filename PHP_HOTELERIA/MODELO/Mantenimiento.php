<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mantenimientos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Tareas de Mantenimiento</h1>
    <a href="index.php" class="volver">⬅ Volver</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Habitación</th>
            <th>Descripción</th>
            <th>Inicio</th>
            <th>Fin Esperado</th>
            <th>Estado</th>
        </tr>
        <?php
        $sql = "SELECT * FROM MANTENIMIENTOS";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['ID_MANTENIMIENTO']}</td>
                        <td>{$row['NUMERO_H']}</td>
                        <td>{$row['DESCRIPCION']}</td>
                        <td>{$row['FECHA_INICIO']}</td>
                        <td>{$row['FECHA_FIN_ESPERADA']}</td>
                        <td>{$row['ESTADO']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay mantenimientos activos</td></tr>";
        }
        ?>
    </table>
</body>
</html>
