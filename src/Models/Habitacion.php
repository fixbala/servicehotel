<?php

namespace Models;

use PDO;

class Habitacion {
    private $conn;
    private $table = 'habitaciones';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las habitaciones por hotel
    public function getAllByHotel($hotel_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE hotel_id = :hotel_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hotel_id', $hotel_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva habitación
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (hotel_id, tipo, acomodacion, cantidad) 
                  VALUES (:hotel_id, :tipo, :acomodacion, :cantidad)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':hotel_id', $data['hotel_id']);
        $stmt->bindParam(':tipo', $data['tipo']);
        $stmt->bindParam(':acomodacion', $data['acomodacion']);
        $stmt->bindParam(':cantidad', $data['cantidad']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar habitaciones por ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
