<?php
require_once '../MODELO/Habitacion.php';
require_once '../MODELO/conexion.php';

class HabitacionesLogica {
    private $conn;

    public function __construct($conexion) {
        $this->conn = $conexion; 
    }

    public function obtenerHabitaciones() {
        $sql = "SELECT * FROM HABITACIONES";
        $result = $this->conn->query($sql);

        $habitaciones = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $habitaciones[] = $row;
            }
        }
        return $habitaciones;
    }

    
    public function obtenerHabitacion($numero_h) {
        $stmt = $this->conn->prepare("SELECT * FROM HABITACIONES WHERE NUMERO_H = ?");
        $stmt->bind_param("i", $numero_h);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

   
    public function crearHabitacion($tipo, $precio_base, $estado_limpieza = 'Limpia') {
        $stmt = $this->conn->prepare("INSERT INTO HABITACIONES (TIPO, PRECIO_BASE, ESTADO_LIMPIEZA) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $tipo, $precio_base, $estado_limpieza);
        return $stmt->execute();
    }

    
    public function actualizarHabitacion($numero_h, $tipo, $precio_base, $estado_limpieza) {
        $stmt = $this->conn->prepare("UPDATE HABITACIONES SET TIPO = ?, PRECIO_BASE = ?, ESTADO_LIMPIEZA = ? WHERE NUMERO_H = ?");
        $stmt->bind_param("sdsi", $tipo, $precio_base, $estado_limpieza, $numero_h);
        return $stmt->execute();
    }

    
    public function eliminarHabitacion($numero_h) {
        $stmt = $this->conn->prepare("DELETE FROM HABITACIONES WHERE NUMERO_H = ?");
        $stmt->bind_param("i", $numero_h);
        return $stmt->execute();
    }
}


$habitacionLogic = new HabitacionesLogica($conn);
?>
