<?php
// resources_base/layout_header.php
// Contiene el inicio del HTML, el Head, y el Header de la página.
// Usamos PHP para que pueda ser incluido por cualquier recurso.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketball Store - Tienda Online MVC</title>
    <!--
        Estilos CSS Puros (Copiados del index.html de la Sesión 1)
        En una práctica real, este CSS debería ir en un archivo externo (.css)
        y ser enlazado aquí: <link rel="stylesheet" href="css/style.css">
    -->
    <style>
        :root {
            --color-primary: #FF5722; /* Naranja Baloncesto */
            --color-secondary: #000000;
            --color-accent: #FFFFFF;
            --color-bg: #f4f4f9;
            --font-family: 'Arial', sans-serif;
        }

        body {
            font-family: var(--font-family);
            margin: 0;
            padding: 0;
            background-color: var(--color-bg);
            color: var(--color-secondary);
            line-height: 1.6;
        }

        a {
            color: var(--color-primary);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        header {
            background-color: var(--color-secondary);
            color: var(--color-accent);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header .logo {
            font-size: 1.8em;
            font-weight: bold;
            color: var(--color-primary);
        }

        /* Navegación Principal */
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: var(--color-accent);
            font-weight: bold;
            padding: 5px 10px;
            transition: color 0.3s;
            text-transform: uppercase;
        }

        nav ul li a:hover {
            color: var(--color-primary);
            text-decoration: none;
        }

        /* Contenido principal */
        main {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
            min-height: 70vh; /* Para dar espacio */
        }

        h1, h2 {
            text-align: center;
            color: var(--color-secondary);
        }

        /* --- Estilos del Catálogo --- */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
            text-align: center;
        }

        .category-card {
            display: block;
            background-color: var(--color-accent);
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .category-card-content {
            padding: 15px;
        }

        .category-card-content h3 {
            margin: 0;
            color: var(--color-secondary);
            font-size: 1.2em;
            text-transform: uppercase;
        }

        .category-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            background-color: #e8e8e8;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            margin-top: 50px;
            border-top: 1px solid #ddd;
            color: #777;
        }

    </style>
</head>
<body>

    <header>
        <div class="logo">BASKETBALL SHOP</div>
        <nav>
            <ul>
                <li><a href="index.php?accio=llistar-categories">Catálogo</a></li>
                <li><a href="index.php?accio=registro">Registrarse</a></li>
                
                <li id="user-menu-container">
                    <a href="#" id="user-menu-link">Mi Cuenta</a>
                    
                    <div id="user-menu-dropdown">
                        <a href="index.php?accio=cuenta">El meu compte</a>
                        <a href="index.php?accio=pedidos">Les meves compres</a>
                        <a href="index.php?accio=logout">Tancar sessió</a>
                    </div>
                </li>
                </ul>
        </nav>
    </header>

    <main>