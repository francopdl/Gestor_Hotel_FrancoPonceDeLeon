<?php
require_once '../MODELO/Reserva.php';
require_once '../MODELO/conexion.php';

class ReservasLogica {
    private $conn;

    public function __construct($conexion) {
        $this->conn = $conexion;
    }

    
    public function obtenerReservas() {
        $sql = "SELECT * FROM RESERVAS";
        $result = $this->conn->query($sql);

        $reservas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reservas[] = $row;
            }
        }
        return $reservas;
    }

   
    public function obtenerReserva($id_reserva) {
        $stmt = $this->conn->prepare("SELECT * FROM RESERVAS WHERE ID_RESERVA = ?");
        $stmt->bind_param("i", $id_reserva);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

  
    public function crearReserva($documento, $numero_h, $fecha_llegada, $fecha_salida, $precio_total, $estado = 'Pendiente') {
        $stmt = $this->conn->prepare("INSERT INTO RESERVAS (DOCUMENTO_IDENTIDAD, NUMERO_H, FECHA_LLEGADA, FECHA_SALIDA, PRECIO_TOTAL, ESTADO) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissds", $documento, $numero_h, $fecha_llegada, $fecha_salida, $precio_total, $estado);
        return $stmt->execute();
    }

    
    public function actualizarReserva($id_reserva, $documento, $numero_h, $fecha_llegada, $fecha_salida, $precio_total, $estado) {
        $stmt = $this->conn->prepare("UPDATE RESERVAS SET DOCUMENTO_IDENTIDAD = ?, NUMERO_H = ?, FECHA_LLEGADA = ?, FECHA_SALIDA = ?, PRECIO_TOTAL = ?, ESTADO = ? WHERE ID_RESERVA = ?");
        $stmt->bind_param("sissdsi", $documento, $numero_h, $fecha_llegada, $fecha_salida, $precio_total, $estado, $id_reserva);
        return $stmt->execute();
    }

   
    public function eliminarReserva($id_reserva) {
        $stmt = $this->conn->prepare("DELETE FROM RESERVAS WHERE ID_RESERVA = ?");
        $stmt->bind_param("i", $id_reserva);
        return $stmt->execute();
    }
}
?>
