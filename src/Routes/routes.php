<?php

use Slim\App;
use Controllers\HotelController;

return function (App $app) {
   // Rutas para Hoteles
   $app->get('/hoteles', [HotelController::class, 'getAll']);
   $app->get('/hoteles/{id}', [HotelController::class, 'getById']);
   $app->post('/hoteles', [HotelController::class, 'create']);
   $app->put('/hoteles/{id}', [HotelController::class, 'update']);
   $app->delete('/hoteles/{id}', [HotelController::class, 'delete']);

   // Rutas para Habitaciones
   $app->get('/habitaciones/{hotel_id}', [HabitacionController::class, 'getAllByHotel']);
   $app->post('/habitaciones', [HabitacionController::class, 'create']);
   $app->delete('/habitaciones/{id}', [HabitacionController::class, 'delete']);
};
 

