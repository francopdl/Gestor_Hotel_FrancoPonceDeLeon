<?php
require_once '../MODELO/Mantenimiento.php';
require_once '../MODELO/conexion.php';

class MantenimientosLogica {
    private $conn;

    public function __construct($conexion) {
        $this->conn = $conexion;
    }

    
    public function obtenerMantenimientos() {
        $sql = "SELECT * FROM MANTENIMIENTOS";
        $result = $this->conn->query($sql);

        $mantenimientos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mantenimientos[] = $row;
            }
        }
        return $mantenimientos;
    }

    
    public function obtenerMantenimiento($id_mantenimiento) {
        $stmt = $this->conn->prepare("SELECT * FROM MANTENIMIENTOS WHERE ID_MANTENIMIENTO = ?");
        $stmt->bind_param("i", $id_mantenimiento);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

   
    public function crearMantenimiento($numero_h, $descripcion, $fecha_inicio, $fecha_fin_esperada, $estado = 'Activo') {
        $stmt = $this->conn->prepare("INSERT INTO MANTENIMIENTOS (NUMERO_H, DESCRIPCION, FECHA_INICIO, FECHA_FIN_ESPERADA, ESTADO) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $numero_h, $descripcion, $fecha_inicio, $fecha_fin_esperada, $estado);
        return $stmt->execute();
    }

   
    public function actualizarMantenimiento($id_mantenimiento, $numero_h, $descripcion, $fecha_inicio, $fecha_fin_esperada, $estado) {
        $stmt = $this->conn->prepare("UPDATE MANTENIMIENTOS SET NUMERO_H = ?, DESCRIPCION = ?, FECHA_INICIO = ?, FECHA_FIN_ESPERADA = ?, ESTADO = ? WHERE ID_MANTENIMIENTO = ?");
        $stmt->bind_param("issssi", $numero_h, $descripcion, $fecha_inicio, $fecha_fin_esperada, $estado, $id_mantenimiento);
        return $stmt->execute();
    }

   
    public function eliminarMantenimiento($id_mantenimiento) {
        $stmt = $this->conn->prepare("DELETE FROM MANTENIMIENTOS WHERE ID_MANTENIMIENTO = ?");
        $stmt->bind_param("i", $id_mantenimiento);
        return $stmt->execute();
    }
}
?>
