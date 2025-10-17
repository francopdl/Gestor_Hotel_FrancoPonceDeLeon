<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Huéspedes</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Lista de Huéspedes</h1>
    <a href="index.php" class="volver">⬅ Volver</a>

    <table>
        <tr>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
        <?php
        $sql = "SELECT * FROM HUESPEDES";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['DOCUMENTO_IDENTIDAD']}</td>
                        <td>{$row['NOMBRE']}</td>
                        <td>{$row['EMAIL']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay huéspedes registrados</td></tr>";
        }
        ?>
    </table>
</body>
</html>
