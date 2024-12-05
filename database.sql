CREATE TABLE hoteles (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL UNIQUE,
    direccion VARCHAR(255),
    ciudad VARCHAR(100),
    nit VARCHAR(20) NOT NULL UNIQUE,
    numero_habitaciones INTEGER NOT NULL
);

CREATE TABLE habitaciones (
    id SERIAL PRIMARY KEY,
    hotel_id INTEGER REFERENCES hoteles(id) ON DELETE CASCADE,
    tipo VARCHAR(50) NOT NULL,
    acomodacion VARCHAR(50) NOT NULL,
    cantidad INTEGER NOT NULL,
    UNIQUE(hotel_id, tipo, acomodacion)
);
