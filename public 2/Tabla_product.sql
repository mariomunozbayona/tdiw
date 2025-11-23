CREATE TABLE product (
    -- ID autoincremental i clau primària 
    id SERIAL PRIMARY KEY,

    -- Nom 
    name VARCHAR(255) NOT NULL,

    -- Descripció 
    description TEXT,

    -- Preu 
    price NUMERIC(10, 2) NOT NULL,

    -- Imatge 
    image VARCHAR(255),

    -- relació amb la taula category
    category_id INTEGER NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,

    CONSTRAINT fk_category
        FOREIGN KEY (category_id)
        REFERENCES category (id)
        -- si la categoria s'esborra, els productes es poden mantenir o esborrar 

        ON DELETE RESTRICT
);