<?php

namespace Controllers;

use Models\Hotel;
use Config\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HotelController {
    private $hotel;

    public function __construct() {
        $db = new Database();
        $this->hotel = new Hotel($db->connect());
    }

    // Obtener todos los hoteles
    public function getAll(Request $request, Response $response) {
        $hoteles = $this->hotel->getAll();
        $response->getBody()->write(json_encode($hoteles));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Obtener un hotel por ID
    public function getById(Request $request, Response $response, $args) {
        $hotel = $this->hotel->getById($args['id']);
        if ($hotel) {
            $response->getBody()->write(json_encode($hotel));
            return $response->withHeader('Content-Type', 'application/json');
        }
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json')->write(json_encode(['error' => 'Hotel not found']));
    }

    // Crear un hotel
    public function create(Request $request, Response $response) {
        $data = $request->getParsedBody();
        if ($this->hotel->create($data)) {
            return $response->withStatus(201)->withHeader('Content-Type', 'application/json')->write(json_encode(['message' => 'Hotel created']));
        }
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json')->write(json_encode(['error' => 'Unable to create hotel']));
    }

    // Actualizar un hotel
    public function update(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        if ($this->hotel->update($args['id'], $data)) {
            return $response->withHeader('Content-Type', 'application/json')->write(json_encode(['message' => 'Hotel updated']));
        }
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json')->write(json_encode(['error' => 'Unable to update hotel']));
    }

    // Eliminar un hotel
    public function delete(Request $request, Response $response, $args) {
        if ($this->hotel->delete($args['id'])) {
            return $response->withHeader('Content-Type', 'application/json')->write(json_encode(['message' => 'Hotel deleted']));
        }
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json')->write(json_encode(['error' => 'Unable to delete hotel']));
    }
}
 