CREATE TABLE carrito (
    id_carrito INT PRIMARY KEY AUTO_INCREMENT,
    id_comprador INT,
    id_producto INT,
    cantidad INT NOT NULL,
    FOREIGN KEY (id_comprador) REFERENCES compradores(id_comprador),
    FOREIGN KEY (id_producto) REFERENCES promociones(id_producto)
);
