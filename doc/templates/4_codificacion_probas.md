# URL da páxina web

# Prototipos realizados

## Prototipo 1

### Data

20-10-2025

### Descripción

Estructura base del proyecto de Laravel. Base de datos creada en phpMyAdmin, tablas añadidas a partir de migraciones y pobladas de valores de prueba con un script SQL en phpMyAdmin. Creados todos los modelos, vistas y controladores.

Añadido el flujo y los comportamientos pertenecientes las siguientes vistas: "lista-tiendas" y "lista-productos" según las vería una persona anónima/consumidora, "lista-usuarios" y "registro-usuario".

De momento el HTML y el CSS son rudimentarios. Se utilizaron comandos de sail y artisan.

## Prototipo 2

### Data

### Descripción

## Prototipo Final

### Data

### Descripción

# Retos e Innovación

## Reto número 1

### Motivación

Crear la web desde un framework con el que esté familiarizado (estudiado en DWCS). Utilizar JS y CSS en las vistas según lo aprendido principalmente en DWCC y DIW.

### Descripción

Creación y despliegue de un proyecto de Laravel desde cero (plantilla por defecto al crearlo) sin ayuda externa. Primera vez que le incorporo archivos de JS y CSS.

## Reto número 2

### Motivación

Se quiere permitir a los usuarios subir imágenes, las cuales en Laravel se guardan en storage/app/public. Pero el navegador a lo que tiene acceso es a /public, así que es necesario crear un symlink para mostrar dichas imágenes en la web.

### Descripción

Aprendizaje sobre enlaces simbólicos (symlink) y su incorporación en Laravel mediante artisan storage:link, así como un mayor entendimiento de las carpetas /public (archivos públicos y estáticos, como el JS o el CSS) y storage/app/public (archivos generados por la web).
