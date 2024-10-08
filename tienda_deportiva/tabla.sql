CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    genero VARCHAR(255) NOT NULL,
    talla VARCHAR(50),
    color VARCHAR(50),
    descripcion TEXT,
    habilitado BOOLEAN DEFAULT true
);