CREATE TABLE promociones (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    marca VARCHAR(50),
    precio_original DECIMAL(10, 2) NOT NULL,
    precio_descuento DECIMAL(10, 2) NOT NULL,
    imagen VARCHAR(255)
);

INSERT INTO promociones (nombre, marca, precio_original, precio_descuento, imagen) 
VALUES 
('Zapatillas Vl Court 3.0 de Hombre', 'Adidas', 250000, 100000, 'images/tenis2.png'),
('Zapatillas UA Surge 3-Gry de Hombre', 'Under Armour', 300000, 180000, 'images/tenis.png'),
('Abrigo Nsw Club Hoodie Po de Hombre', 'Nike', 350000, 160000, 'images/equipacion.png');
