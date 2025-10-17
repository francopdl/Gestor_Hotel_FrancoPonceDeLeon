<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Habitaciones</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Habitaciones del Hotel</h1>
    <a href="index.php" class="volver">⬅ Volver</a>
    <table>
        <tr>
            <th>Número</th>
            <th>Tipo</th>
            <th>Precio Base</th>
            <th>Estado Limpieza</th>
        </tr>
        <?php
        $sql = "SELECT * FROM HABITACIONES";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['NUMERO_H']}</td>
                        <td>{$row['TIPO']}</td>
                        <td>{$row['PRECIO_BASE']}</td>
                        <td>{$row['ESTADO_LIMPIEZA']}</td> </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay habitaciones registradas</td></tr>";
        }
        ?>
    </table>
</body>
</html>
