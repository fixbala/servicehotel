# Gestión de Hoteles - API RESTful

Este proyecto es una API RESTful desarrollada en PHP utilizando el framework Slim. Permite gestionar hoteles y sus habitaciones, cumpliendo con las especificaciones técnicas y funcionales descritas.

---

## **Características del Proyecto**

1. Gestión completa de **Hoteles**:
   - Crear, leer, actualizar y eliminar hoteles.
   - Validación de unicidad por nombre y NIT.

2. Gestión de **Habitaciones**:
   - Crear, listar y eliminar habitaciones para cada hotel.
   - Validaciones estrictas según tipo y acomodación:
     - Estándar: Sencilla o Doble.
     - Junior: Triple o Cuádruple.
     - Suite: Sencilla, Doble o Triple.

3. Backend desacoplado y basado en el principio RESTful.
4. Documentación de API en formato Postman (`postman_collection.json`).

---

## **Tecnologías Utilizadas**

- **Lenguaje:** PHP 8+
- **Framework:** Slim Framework 4
- **Base de Datos:** PostgreSQL
- **ORM:** PDO (PHP Data Objects)
- **Gestión de Dependencias:** Composer
- **Documentación de API:** Postman
- **Servidor Local:** PHP Built-in Server

---

## **Requisitos Previos**

1. **Entorno Local:**
   - PHP 8+ instalado.
   - Composer instalado.
   - PostgreSQL instalado y configurado.

2. **Dependencias del Proyecto:**
   - Slim Framework.
   - Dotenv para manejo de variables de entorno.

3. **Herramientas de Prueba:**
   - Postman o cURL.

---

## **Configuración e Instalación**

### **1. Clonar el Repositorio**
```bash
git clone <url-del-repositorio>
cd hotel-management

## **Instalar Dependencias**
composer install

## **Configurar Variables de Entorno**
Crea un archivo .env en la raíz del proyecto con el siguiente contenido:

DB_HOST=localhost
DB_PORT=5432
DB_NAME=hoteles_db
DB_USER=postgres
DB_PASSWORD=tu_password

## **Configurar la Base de Datos**
Crea la base de datos en PostgreSQL:

CREATE DATABASE hoteles_db;
Ejecuta el archivo database.sql para crear las tablas:

terminal
psql -U postgres -d hoteles_db -f database.


## **Ejecución del Proyecto**
Levanta el servidor local:
terminal
php -S localhost:8000 -t public

La API estará disponible en http://localhost:8000.

Pruebas de la API
Importar la Documentación en Postman
Abre Postman.
Ve a File > Import y selecciona postman_collection.json.
Ejecuta las rutas disponibles para probar las funcionalidades.
Pruebas Básicas
GET /hoteles: Obtener la lista de hoteles.
POST /hoteles: Crear un nuevo hotel. Ejemplo de cuerpo JSON

json:
{
  "nombre": "Decameron Test",
  "direccion": "Calle 123",
  "ciudad": "Bogotá",
  "nit": "12345678-9",
  "numero_habitaciones": 50
}

GET /habitaciones/{hotel_id}: Listar habitaciones de un hotel.
POST /habitaciones: Crear una nueva habitación. Ejemplo:
terminal
{
  "hotel_id": 1,
  "tipo": "Estándar",
  "acomodacion": "Sencilla",
  "cantidad": 10
}

DELETE /habitaciones/{id}: Eliminar una habitación.

Estructura del Proyecto
hotel-management/
├── public/
│   └── index.php
├── src/
│   ├── Config/
│   │   └── database.php
│   ├── Controllers/
│   │   ├── HotelController.php
│   │   └── HabitacionController.php
│   ├── Models/
│   │   ├── Hotel.php
│   │   └── Habitacion.php
│   ├── Routes/
│   │   └── routes.php
├── tests/
├── vendor/  # Creado por Composer
├── composer.json
├── .env
├── database.sql
└── postman_collection.json
