<?php

namespace Models;

use PDO;

class Hotel {
    private $conn;
    private $table = 'hoteles';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los hoteles
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo hotel
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (nombre, direccion, ciudad, nit, numero_habitaciones) 
                  VALUES (:nombre, :direccion, :ciudad, :nit, :numero_habitaciones)";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':direccion', $data['direccion']);
        $stmt->bindParam(':ciudad', $data['ciudad']);
        $stmt->bindParam(':nit', $data['nit']);
        $stmt->bindParam(':numero_habitaciones', $data['numero_habitaciones']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Obtener un hotel por ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un hotel
    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET nombre = :nombre, direccion = :direccion, ciudad = :ciudad, nit = :nit, numero_habitaciones = :numero_habitaciones 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':direccion', $data['direccion']);
        $stmt->bindParam(':ciudad', $data['ciudad']);
        $stmt->bindParam(':nit', $data['nit']);
        $stmt->bindParam(':numero_habitaciones', $data['numero_habitaciones']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    } 

    // Eliminar un hotel
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
