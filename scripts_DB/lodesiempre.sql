-- Crear la BBDD si no existe ya para poder usarla

-- CREATE DATABASE IF NOT EXISTS lodesiempre;
USE lodesiempre;

-- Crear tablas si no existen ya

-- CREATE TABLE IF NOT EXISTS usuario(
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     nombre VARCHAR(120) NOT NULL UNIQUE,
--     contrasena VARCHAR(120) NOT NULL,
--     tipo ENUM('consumidor', 'vendedor', 'admin') NOT NULL,
--     email VARCHAR(120) UNIQUE
-- );

-- CREATE TABLE IF NOT EXISTS tienda(
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     nombre VARCHAR(120) NOT NULL UNIQUE,
--     provincia ENUM('A Coruña', 'Pontevedra') NOT NULL,
--     descripcion VARCHAR(255),
--     icono VARCHAR(255),
--     verif BOOLEAN DEFAULT FALSE,
--     usuario_id INT NOT NULL UNIQUE,
--     CONSTRAINT fk_tienda_usuario FOREIGN KEY(usuario_id) REFERENCES usuario(id)
--         ON DELETE CASCADE ON UPDATE CASCADE
-- );

-- CREATE TABLE IF NOT EXISTS carrito(
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     usuario_id INT NOT NULL UNIQUE,
--     CONSTRAINT fk_carrito_usuario FOREIGN KEY(usuario_id) REFERENCES usuario(id)
--         ON DELETE CASCADE ON UPDATE CASCADE
-- );

-- CREATE TABLE IF NOT EXISTS producto(
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     nombre VARCHAR(120) NOT NULL,
--     precio DECIMAL(4,2) NOT NULL,
--     descripcion VARCHAR(255),
--     imagen VARCHAR(255),
--     tienda_id INT NOT NULL,
--     CONSTRAINT fk_producto_tienda FOREIGN KEY(tienda_id) REFERENCES tienda(id)
--         ON DELETE CASCADE ON UPDATE CASCADE
-- );

-- CREATE TABLE IF NOT EXISTS carrito_producto(
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     carrito_id INT NOT NULL,
--     producto_id INT NOT NULL,
--     cantidad INT NOT NULL DEFAULT 1,
--     CONSTRAINT fk_carrito_producto_carr FOREIGN KEY(carrito_id) REFERENCES carrito(id)
--         ON DELETE CASCADE ON UPDATE CASCADE,

--     CONSTRAINT fk_carrito_producto_prod FOREIGN KEY(producto_id) REFERENCES producto(id)
--         ON DELETE CASCADE ON UPDATE CASCADE
-- );

-- Cargar datos a las tablas

INSERT INTO usuarios (nombre, contrasena, tipo) VALUES ('marcos', 'Abc123..', 'admin');
INSERT INTO usuarios (nombre, contrasena, tipo, email) VALUES
('Noa', 'Abc123...', 'admin', 'noa@lodesiempre.com'),
('Juan', 'Abc123....', 'admin', 'juan@lodesiempre.com'),
('Carmen', 'Tenda123.', 'vendedor', 'lola@tendacarmen.com'),
('Manuel', 'Forno123.', 'vendedor', 'manuel@ofornovello.com'),
('Rosalía', 'Flor123.', 'vendedor', 'rosalia@floristeriarosalia.com'),
('Xurxo', 'Neboa123.', 'vendedor', 'xurxo@librerianeboa.com'),
('Inés', 'Castro123.', 'vendedor', 'ines@castroartesania.com'),
('Jorge', 'Abc123....', 'consumidor', 'jorgeds87@gmail.com'),
('Gabriela', 'Abc123....', 'consumidor', 'gabrielaa1976@gmail.com');

INSERT INTO tiendas (nombre, provincia, descripcion, icono, verif, usuario_id) VALUES
('A Tenda de Carmen', 'A Coruña', 'Ultramarinos de barrio con productos frescos y pan del día.', NULL, true, 4),
('O Forno Vello', 'Pontevedra', 'Panadería artesanal desde 1982.', 'panes.jpg', false, 5),
('Floristería Rosalía', 'A Coruña', 'Flores y plantas de todos los colores y gustos.', 'ramoflores.jpg', false, 6),
('Librería Néboa', 'Pontevedra', 'Librería independiente centrada en literatura gallega.', 'libros.jpg', true, 7),
('Castro Artesanía', 'A Coruña', 'Tienda familiar de artesanía en cerámica y cuero.', NULL, true, 8);

INSERT INTO productos (nombre, precio, descripcion, tienda_id) VALUES
('Pan de centeno', 1.20, NULL, 1),
('Leche semidesnatada', 0.95, NULL, 1),
('Queso de cabra', 3.50, NULL, 1),
('Chorizo casero', 4.20, 'Elaborado con carne de cerdo gallego y especias tradicionales.', 1),
('Miel artesanal', 6.80, 'Producida por apicultores locales en A Coruña.', 1);
INSERT INTO productos (nombre, precio, descripcion, imagen, tienda_id) VALUES
('Pan de bola', 1.00, NULL, 'bola.jpg', 2),
('Empanada de atún', 2.80, NULL, NULL, 2),
('Croissant de mantequilla', 1.10, NULL, NULL, 2),
('Bica artesana', 5.00, 'Bizcocho tradicional gallego hecho en horno de leña.', NULL, 2),
('Rosca de Pascua', 4.50, 'Postre típico de Semana Santa hecho a mano.', NULL, 2);
INSERT INTO productos (nombre, precio, descripcion, imagen, tienda_id) VALUES
('Ramo de rosas', 15.00, NULL, NULL, 3),
('Maceta de suculentas', 8.50, NULL, NULL, 3),
('Claveles variados', 10.00, NULL, NULL, 3),
('Centro floral', 25.00, 'Decoración floral personalizada para eventos.', NULL, 3),
('Orquídea blanca', 18.00, 'Planta ornamental tropical en maceta.', NULL, 3);
INSERT INTO productos (nombre, precio, descripcion, tienda_id) VALUES
('Cantares Gallegos', 12.00, NULL, 4),
('Memorias dun neno labrego', 10.50, NULL, 4),
('O lapis do carpinteiro', 11.80, NULL, 4),
('Atlas das árbores de Galicia', 22.00, 'Edición ilustrada sobre flora autóctona gallega.', 4),
('Contos da néboa', 14.50, 'Recopilación de relatos breves contemporáneos.', 4);
INSERT INTO productos (nombre, precio, descripcion, tienda_id) VALUES
('Taza de barro', 6.00, NULL, 5),
('Cesta de mimbre', 12.50, NULL, 5),
('Pulsera de cuero', 8.00, NULL, 5),
('Jarra pintada', 18.00, 'Hecha a mano con motivos celtas.', 5),
('Manta artesanal', 28.00, 'Confeccionada en telar tradicional.', 5);

