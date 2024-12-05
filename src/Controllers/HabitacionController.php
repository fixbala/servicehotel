<?php

namespace Controllers;

use Models\Habitacion;
use Config\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HabitacionController {
    private $habitacion;

    public function __construct() {
        $db = new Database();
        $this->habitacion = new Habitacion($db->connect());
    }

    // Obtener todas las habitaciones de un hotel
    public function getAllByHotel(Request $request, Response $response, $args) {
        $habitaciones = $this->habitacion->getAllByHotel($args['hotel_id']);
        $response->getBody()->write(json_encode($habitaciones));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Crear una nueva habitación
    public function create(Request $request, Response $response) {
        $data = $request->getParsedBody();

        // Validaciones
        if (!in_array($data['tipo'], ['Estándar', 'Junior', 'Suite']) ||
            !in_array($data['acomodacion'], $this->validAcomodaciones($data['tipo']))) {
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json')
                            ->write(json_encode(['error' => 'Invalid type or accommodation']));
        }

        if ($this->habitacion->create($data)) {
            return $response->withStatus(201)->withHeader('Content-Type', 'application/json')
                            ->write(json_encode(['message' => 'Room created']));
        }
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json')
                        ->write(json_encode(['error' => 'Unable to create room']));
    }

    // Eliminar una habitación
    public function delete(Request $request, Response $response, $args) {
        if ($this->habitacion->delete($args['id'])) {
            return $response->withHeader('Content-Type', 'application/json')
                            ->write(json_encode(['message' => 'Room deleted']));
        }
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json')
                        ->write(json_encode(['error' => 'Unable to delete room']));
    }

    // Validaciones de acomodaciones
    private function validAcomodaciones($tipo) {
        $map = [
            'Estándar' => ['Sencilla', 'Doble'],
            'Junior'   => ['Triple', 'Cuádruple'],
            'Suite'    => ['Sencilla', 'Doble', 'Triple']
        ];
        return $map[$tipo] ?? [];
    }
}
