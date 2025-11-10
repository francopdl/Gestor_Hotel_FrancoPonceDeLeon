<?php
session_start();
require_once "../MODELO/conexion.php";

// Revisar si hay cookie de color
$colorUsuario = $_COOKIE['colorUsuario'] ?? '#ffffff'; // color por defecto blanco

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Si presionaron el botón de confirmar color
    if (isset($_POST['guardarColor'])) {
        $colorElegido = $_POST['color'] ?? '#ffffff';
        setcookie('colorUsuario', $colorElegido, time() + (30 * 24 * 60 * 60), "/");
        $colorUsuario = $colorElegido; // aplicar inmediatamente
    }

    // Si presionaron el botón de entrar (login)
    if (isset($_POST['entrar'])) {
        $emailIngresado = $_POST['email'] ?? '';
        $passwordIngresada = $_POST['password'] ?? '';

        // Buscar usuario por EMAIL
        $sql = "SELECT * FROM HUESPEDES WHERE EMAIL = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $emailIngresado);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            // Verificar contraseña (texto plano o hash)
            if ($passwordIngresada === $usuario['CONTRASENA'] || password_verify($passwordIngresada, $usuario['CONTRASENA'])) {
                $_SESSION['autenticado'] = true;
                $_SESSION['email'] = $usuario['EMAIL'];
                $_SESSION['nombre'] = $usuario['NOMBRE'];
                $_SESSION['rol'] = $usuario['ROL'];

                // Redirigir según rol
                if ($usuario['ROL'] === 'Admin') {
                    header("Location: ../VISTA/index.php");
                } else {
                    header("Location: ../VISTA/reservas.php");
                }
                exit;
            } else {
                $mensajeError = "Contraseña incorrecta.";
            }
        } else {
            $mensajeError = "El correo no está registrado.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Gestión Hotelera</title>
    <style>
        body {
            background-color: <?php echo $colorUsuario; ?>;
        }
    </style>
</head>
<body>
    <h3>Iniciar sesión</h3>

    <?php if (isset($mensajeError)): ?>
        <p style="color:red;"><?php echo $mensajeError; ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label for="email">Correo electrónico:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="color">Elige tu color de fondo:</label><br>
        <input type="color" id="color" name="color" value="<?php echo $colorUsuario; ?>"><br><br>

        <!-- Botón para cambiar solo el color -->
        <button type="submit" name="guardarColor">Confirmar color</button>

        <!-- Botón para hacer login -->
        <button type="submit" name="entrar">Entrar</button>
    </form>
</body>
</html>
