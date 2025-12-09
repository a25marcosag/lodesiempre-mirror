# Implantación

## Manual técnico de instalación del proyecto

Este proyecto se realizó en una VM con Debian 12, por lo que se recomienda trabajar en ese mismo sistema operativo para evitar posibles problemas de incompatibilidad. Es necesario instalar Docker (https://docs.docker.com/engine/install/debian/), Git y cURL:

```bash
    sudo apt update
    sudo apt install git curl
    git --version
    curl --version
```

Lo primero que se ha de hacer es obtener los archivos del proyecto, ya sea con un git clone o descarga directa en .zip desde la interfaz gráfica web de GitLab. Faltan archivos necesarios para el desarrollo en local, como la carpeta de dependencias /vendor, debido a su gran tamaño. Lo más recomendado para obtenerlos sería crear un proyecto limpio de Laravel localmente (luego habría que copiar los archivos pertinentes del mío a este nuevo proyecto o viceversa):

```bash
    curl -s https://laravel.build/nombredelproyecto | bash
```

Una vez se esté en [la carpeta raíz del proyecto de Laravel](codigo/), se debe ejecutar este comando de Laravel Sail (wrapper de Docker Compose que simplifica y automatiza su uso) para levantar el proyecto Laravel con todos los contenedores definidos en el docker-compose.yml:

```bash
    ./vendor/bin/sail up
```

Ahora la página web estará disponible en localhost desde cualquier navegador web. Los contenedores pueden detenerse con Ctrl+C o ejecutando:

```bash
    ./vendor/bin/sail down
```

La primera vez será necesario crear la BBDD con este comando de Artisan:

```bash
    artisan migrate
```

Artisan es la interfaz de línea de comandos (CLI) de Laravel. Comandos útiles:

```bash
    # Resetear la BBDD (droppea todas las tablas, corre las migraciones y los seeders)
    artisan migrate:fresh --seed
    # Crear controlador con plantilla genérica de, por ejemplo, Tienda
    artisan make:controller Tienda
    # Modelo + migración
    artisan make:model Tienda -m
    # Seeder
    artisan make:seeder
```

Para su puesta en producción, se debe colocar el [código fuente](codigo/) en un repositorio público de GitHub. Luego, se debe crear una cuenta de Render y en el dashboard crear un proyecto de tipo servicio web a través de repositorio público de GitHub con Dockerfile (seleccionando el recién creado). Render proporcionará una [url pública](https://lodesiempre-1254.onrender.com). Dentro del servicio web, se debe ir a Entorno > Variables de Entorno y configurar las variables necesarias (estas sobreescribirán las ya existentes en el archivo .env del repositorio público de GitHub):

![Captura de la configuración de variables de entorno en Render](../img/VariablesEntornoRender.jpg)

## Mejoras futuras

En caso de que se quisiese convertir en un servicio comercial real, es recomendable no tener las variables de entorno APP_KEY ni RESEND_API_KEY (esta se obtiene creando una cuenta de Resend, necesaria para el envío de correos) en el .env. En su lugar, pueden configurarse en Render (captura superior), donde solo serán visibles para el propietario de la cuenta de Render. También debería sustituirse la [Licencia MIT](/LICENSE) por una licencia propietaria que permita la correcta explotación comercial, como por ejemplo el EULA (End User License Agreement).
