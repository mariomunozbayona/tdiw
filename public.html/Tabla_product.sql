CREATE TABLE product (
    -- ID autoincremental i clau primària 
    id SERIAL PRIMARY KEY,

    -- Camp mínim: Nom 
    name VARCHAR(255) NOT NULL,

    -- Camp mínim: Descripció 
    description TEXT,

    -- Camp mínim: Preu 
    price NUMERIC(10, 2) NOT NULL,

    -- Camp mínim: Imatge 
    image VARCHAR(255),

    -- Relació amb la taula category
    category_id INTEGER NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,

    -- Definició de la Clau Forana (Foreign Key)
    CONSTRAINT fk_category
        FOREIGN KEY (category_id)
        REFERENCES category (id)
        -- Si la categoria s'esborra, els productes es poden mantenir (SET NULL) o esborrar (CASCADE).

        ON DELETE RESTRICT
);