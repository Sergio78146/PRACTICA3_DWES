CREATE DATABASE proyecto;

USE proyecto;

CREATE TABLE familias (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE productos (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    nombre_corto VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    familia INT NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (familia) REFERENCES familias(codigo)
);

-- Insertar datos iniciales 
INSERT INTO familias (nombre) VALUES ('Electrónica'), ('Hogar'), ('Oficina');

INSERT INTO productos (nombre, nombre_corto, precio, familia, descripcion)
VALUES
('Laptop HP', 'HP 15', 799.99, 1, 'Laptop con 8GB de RAM y 256GB SSD.'),
('Cafetera', 'Cafetera Delonghi', 49.99, 2, 'Cafetera automática con temporizador.'),
('Escritorio', 'DeskPro', 120.00, 3, 'Escritorio ergonómico de madera.');
