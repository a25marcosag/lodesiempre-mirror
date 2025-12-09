# URL pública de la web

[lodesiempre-1254.onrender.com](https://lodesiempre-1254.onrender.com)

# Prototipos realizados

## Prototipo 1

### Fecha

20-10-2025

### Descripción

Estructura base del proyecto de Laravel. Base de datos creada en phpMyAdmin, tablas añadidas a partir de migraciones y pobladas de valores de prueba con un script SQL en phpMyAdmin. Creados todos los modelos, vistas y controladores.

Añadido el flujo y los comportamientos pertenecientes a las siguientes vistas: "lista-tiendas" y "lista-productos" según las vería una persona anónima/consumidora, "lista-usuarios" y "registro-usuario".

De momento el HTML y el CSS son rudimentarios. Se utilizaron comandos de sail y artisan.

## Prototipo 2

### Fecha

4-11-2025

### Descripción

Añadido registro, inicio y cierre de sesión con manejo de errores. Al registrarse como vendedor se crea una nueva tienda asociada a ese usuario, al igual que al eliminarlo se elimina también su tienda. Todas las vistas actualizadas para que muestren solo los elementos pertinentes al tipo de usuario.

Cambiado el tipo de edición de usuario/tienda/producto a un popup. Añadido JS con la finalidad de reutilizar un solo popup para la edición de cada usuario/producto de la lista.

Ahora la BBDD se rellena de valores de prueba desde un seeder. Proyecto desplegado en la web junto con su BBDD (migraciones+seeder) con hosting desde Render.

Todo el comportamiento principal de la página está ahora completo, exceptuando el carrito.

## Prototipo 3

### Fecha

24-11-2025

### Descripción

Añadido un carrito AJAX que afecta a la BBDD si es de un usuario cliente o se guarda en una variable temporal de sesión si es de un usuario anónimo. Se pueden añadir productos y, ya en el carrito, sumar/restar unidades de cada uno, borrarlos uno a uno o vaciar el carrito de golpe. Al intentar comprar como anónimo lleva a la vista de inicio de sesión.

Ahora se pueden subir y borrar imágenes para las tiendas/productos. Añadido botón en el footer para borrar la cuenta del usuario logueado (junto con su tienda/carrito correspondiente).

Diversas mejoras en la lógica del código, así como visuales. Ahora la página tiene diseño responsive.

## Prototipo Final

### Fecha

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

## Reto número 3

### Motivación

Ya que es un proyecto de Laravel y creo las tablas de la BBDD con migraciones, quería poblarlas también utilizando seeders. Además, eran necesarios para que la BBDD contase con valores iniciales en el entorno web de producción.

### Descripción

Aprendizaje e implementación de un seeder que puebla las tablas de la BBDD con valores base, antes introducidos con un script SQL desde phpMyAdmin.

## Reto número 4

### Motivación

Contar con una url pública con la que se pueda acceder al proyecto desde un navegador. Esto ya lo había hecho anteriormente ya sea desde GitHub Pages o desde una web de hosting especializada (Netlify), pero era para webs sin BBDD que no eran dependientes de otros servicios.

### Descripción

Investigación sobre como sería posible el hosting de este proyecto de manera gratuita, manteniendo las migraciones y los mismos servicios que en local (php, sist. de gestión de BBDD y serv. Apache). Tras probar GitLab CI/CD y Railway, me decanté por Render utilizando un repositorio de GitHub público con Dockerfile.

## Reto número 5

### Motivación

Incorporar AJAX con JSON a la web, específicamente al carrito para que toda su edición sea asíncrona.

### Descripción

Incorporación por primera vez de operaciones AJAX a un backend real, concretamente con sintaxis PHP de Laravel.
