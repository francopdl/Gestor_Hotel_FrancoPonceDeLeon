<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Reservas del Hotel</h1>
    <a href="index.php" class="volver">⬅ Volver</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Huésped</th>
            <th>Habitación</th>
            <th>Fecha Llegada</th>
            <th>Fecha Salida</th>
            <th>Estado</th>
        </tr>
        <?php
        $sql = "SELECT R.ID_RESERVA, H.NOMBRE, R.NUMERO_H, R.FECHA_LLEGADA, R.FECHA_SALIDA, R.ESTADO 
                FROM RESERVAS R
                JOIN HUESPEDES H ON R.DOCUMENTO_IDENTIDAD = H.DOCUMENTO_IDENTIDAD";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['ID_RESERVA']}</td>
                        <td>{$row['NOMBRE']}</td>
                        <td>{$row['NUMERO_H']}</td>
                        <td>{$row['FECHA_LLEGADA']}</td>
                        <td>{$row['FECHA_SALIDA']}</td>
                        <td>{$row['ESTADO']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay reservas registradas</td></tr>";
        }
        ?>
    </table>
</body>
</html>
