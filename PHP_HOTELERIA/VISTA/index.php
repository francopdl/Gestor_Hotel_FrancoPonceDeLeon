<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión Hotelera</title>
    <link rel="stylesheet" href="../estilos.css">
    <style>
        
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-image: url('https://sedetucuman.com.ar/gestor/wp-content/uploads/2020/05/piscina-hotel-sol-san-javier-02.jpg'); 
            background-size: cover;       
            background-position: center;  
            background-repeat: no-repeat;
            background-attachment: fixed; 
            color: white;
        }

       
        .container {
            text-align: center;
            margin: 0 auto;
            padding: 40px;
            border-radius: 12px;
            background-color: rgba(0, 0, 0, 0.5); /* semi-transparente */
            width: 80%;
            max-width: 800px;
            margin-top: 80px;
        }

        h1 {
            color: #fff;
            margin-bottom: 40px;
        }

        .menu {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .card {
            background-color: #40739e;
            color: white;
            padding: 20px 40px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 18px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover {
            background-color: #273c75;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1> Hotel el Gran Descanso</h1>
        <div class="menu">
            <a href="habitaciones.php" class="card">Habitaciones</a>
            <a href="huespedes.php" class="card">Huéspedes</a>
            <a href="reservas.php" class="card">Reservas</a>
            <a href="mantenimiento.php" class="card">Mantenimiento</a>
        </div>
    </div>
</body>
</html>
