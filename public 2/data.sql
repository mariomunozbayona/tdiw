CREATE TABLE category (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE
);

CREATE TABLE product (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price NUMERIC(10, 2) NOT NULL,
    image VARCHAR(255),
    category_id INTEGER NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,

    CONSTRAINT fk_category
        FOREIGN KEY (category_id)
        REFERENCES category (id)
        ON DELETE RESTRICT
);

CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    city VARCHAR(255),
    zip_code VARCHAR(5),
    is_active BOOLEAN DEFAULT TRUE
);

-- 1. CAMISETAS (ID = 1)
INSERT INTO category (name, description) VALUES 
('Camisetas', 'Jerseys, sudaderas y ropa interior térmica.');

-- 2. PANTALONES (ID = 2)
INSERT INTO category (name, description) VALUES 
('Pantalones', 'Shorts de juego, pantalones de chándal y mallas de compresión.');

-- 3. EQUIPACIONES (ID = 3)
INSERT INTO category (name, description) VALUES 
('Equipaciones', 'Conjuntos completos de juego para partidos y entrenamientos.');

-- 4. ACCESORIOS (ID = 4)
INSERT INTO category (name, description) VALUES 
('Accesorios', 'Muñequeras, protectores, balones y bolsas de deporte.');

-- 5. BAMBAS (ID = 5)
INSERT INTO category (name, description) VALUES 
('Bambas', 'Calzado de baloncesto.');

INSERT INTO product (name, description, price, image, category_id) VALUES 
('Jersey Chicago Bulls - Jordan', 'Camiseta réplica de la temporada 97. Tecnología Dri-FIT.', 89.95, 'img/img/jordan.jpg', 1),
('Sudadera con Capucha Lakers', 'Sudadera oficial de algodón con logo del equipo bordado.', 65.00, 'img/img/sudadera-los-angeles-lakers-dri-fit-fz-showtime.jpg', 1),
('Camiseta Térmica Nike Pro', 'Capa base de compresión para invierno. Color negro.', 35.50, 'img/img/CU6740-010_sudadera-color-negro-nike-pro-warm_1_completa-frontal.jpg', 1),
('Jersey Milwaukee Bucks - Antetokounmpo', 'Camiseta réplica de la temporada 24. Tecnología Dri-FIT.', 89.95, 'img/img/Giannis.jpg', 1);

INSERT INTO product (name, description, price, image, category_id) VALUES 
('Shorts Golden State Warriors', 'Pantalón corto oficial de la NBA, tejido ligero.', 55.00, 'img/img/GSW.jpg', 2),
('Pantalón Chándal Training Negro', 'Pantalón largo con puños elásticos y cremalleras.', 49.95, 'img/img/pantalon-negro.jpg', 2),
('Malla Compresión Larga', 'Mallas para soporte muscular durante el juego.', 40.00, 'img/img/malla.jpg', 2),
('Shorts Oklahoma City Thunder', 'Pantalón corto oficial de la NBA, tejido ligero.', 55.00, 'img/img/OKC.jpg', 2);

INSERT INTO product (name, description, price, image, category_id) VALUES 
('Equipación Replica Lakers (Adulto)', 'Conjunto de jersey y shorts de "Los Angeles Lakers".".', 110.00, 'img/img/lakers-equipacion.jpg', 3),
('Equipación Replica Nuggets', 'Conjunto de jersey y shorts de los "Denver Nuggets".', 110.00, 'img/img/denver.jpg', 3),
('Equipación Replica Pacers', 'Conjunto de jersey y shorts de los "Indiana Pacers".', 110.00, 'img/img/indiana.jpg', 3);

INSERT INTO product (name, description, price, image, category_id) VALUES 
('Balón Spalding NBA Oficial', 'Balón de piel oficial de la NBA (Talla 7).', 149.90, 'img/img/balón.jpg', 4),
('Muñequera Larga Compresión Negra', 'Muñequera elástica para absorber el sudor.', 12.50, 'img/img/muñequera.jpg', 4),
('Bolsa de Deporte', 'Bolsa grande con compartimento separado para zapatillas.', 39.95, 'img/img/bolsa.jpg', 4),
('Protector Bucal Transparente', 'Protección dental para juego intenso.', 8.99, 'img/img/protector.jpg', 4);

INSERT INTO product (name, description, price, image, category_id) VALUES 
('Bambas Air Hyperdunk 2017 (Azul)', 'Calzado con amortiguación de aire y suela antideslizante.', 125.99, 'img/img/hyperdunk.jpg', 5),
('Bambas Curry Flow 10', 'Modelo ligero, bajo perfil y máxima tracción.', 139.90, 'img/img/curry10.jpg', 5),
('Bambas Retro 4 Jordan', 'Re-edición del modelo clásico de 1989.', 199.00, 'img/img/jordan4.jpg', 5);
