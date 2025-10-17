<?php
require_once '../MODELO/Huesped.php';
require_once '../MODELO/conexion.php';

class HuespedesLogica {
    private $conn;

    public function __construct($conexion) {
        $this->conn = $conexion;
    }

    public function obtenerHuespedes() {
        $sql = "SELECT * FROM HUESPEDES";
        $result = $this->conn->query($sql);

        $huespedes = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $huespedes[] = $row;
            }
        }
        return $huespedes;
    }

   
    public function obtenerHuesped($documento) {
        $stmt = $this->conn->prepare("SELECT * FROM HUESPEDES WHERE DOCUMENTO_IDENTIDAD = ?");
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    
    public function crearHuesped($documento, $nombre, $email) {
        $stmt = $this->conn->prepare("INSERT INTO HUESPEDES (DOCUMENTO_IDENTIDAD, NOMBRE, EMAIL) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $documento, $nombre, $email);
        return $stmt->execute();
    }

    
    public function actualizarHuesped($documento, $nombre, $email) {
        $stmt = $this->conn->prepare("UPDATE HUESPEDES SET NOMBRE = ?, EMAIL = ? WHERE DOCUMENTO_IDENTIDAD = ?");
        $stmt->bind_param("sss", $nombre, $email, $documento);
        return $stmt->execute();
    }

    
    public function eliminarHuesped($documento) {
        $stmt = $this->conn->prepare("DELETE FROM HUESPEDES WHERE DOCUMENTO_IDENTIDAD = ?");
        $stmt->bind_param("s", $documento);
        return $stmt->execute();
    }
}
?>
