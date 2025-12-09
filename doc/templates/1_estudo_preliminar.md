# Estudio preliminar - Anteproyecto

## Descripción del proyecto

El proyecto consiste en una **web responsive de compra-venta de productos locales** de todo tipo. Está destinada a ofrecer un **marketplace online B2C** (de empresa a persona consumidora) que permita **recogida en tienda** o **entrega a domicilio**.

Las personas vendedoras podrán registrar su tienda, modificar su perfil y gestionar su stock. Las personas clientas podrán acceder a una lista de tiendas y, al clicar en una, a su lista de productos. Las tiendas, los productos y el equipo administrador de la web estarán almacenados en una base de datos. El equipo administrador podrá utilizar la web para gestiones rápidas en la base de datos.

Inicialmente se enfocaría a las provincias de A Coruña y Pontevedra (por cercanía y densidad de población). Nombre de la web: **LoDeSiempre** (corto y fácil de recordar, evoca comprar en una tienda de barrio, nombre español y no inglés para ser más cercano a la persona consumidora).

### Justificación del proyecto

Promocionar la venta local de **PYMES** y **personas autónomas**, facilitando su relación con la persona consumidora y buscando generar un interés positivo en esta a base de esta premisa. Por ello se enfocará el marketing a la persona consumidora. Se buscará especialmente la venta de utensilios y productos pequeños de bajo coste, para envíos ligeros y rápidos independientemente del tamaño de la cesta. Se busca que las propias personas consumidoras y el boca a boca atraiga más **personas vendedoras que serán la fuente de ingresos principal**.

La idea surgió con dos tiendas. Una era de mi barrio y quería ver si tendrían algo que me interesase pero tenía un horario inusual y cada vez que pasaba por delante estaba cerrada. A la otra tienda tenía que ir pero estaba en la otra punta de mi ciudad y si pidiese el producto por Amazon aún tardaría un tiempo en llegar. La primera era un negocio pequeño y la segunda pertenecía a una persona mayor. Ninguna de las dos tenía presencia online. Si hubiese una web como LoDeSiempre, podría **ojear el catálogo de la primera tienda y sus productos en stock en cualquier momento** y la persona de la segunda tienda podría ofrecer **entregas a domicilio de manera asequible, con apenas trámites y sin tener que saber mucho de tecnología**. También vi que en tiendas como ferreterías o mercerías puede llegar a formarse mucha cola, con esta web se podría **saltar esa cola para recoger tu pedido ya preparado**. Además, en mi entorno he apreciado que existe un **mercado de posibles personas clientas que buscan una alternativa local a multinacionales extranjeras como Amazon**.

A nivel técnico, buscaba crear un proyecto de Laravel que fuese una web con estructura MVC y distintos tipos de usuario para mostrar/crear/editar/eliminar el contenido de una BBDD, incorporando CSS y JS.

### Funcionalidades del proyecto

Si el usuario es una:

- **Persona cliente**:
  - Acceso a una lista de tiendas con buscador.
  - Visualización del stock de cada tienda.
  - Creación de un carrito de la compra.
  - Elección entre recogida en tienda o envío a domicilio.
- **Tienda**:
  - Modificación de su perfil (nombre, icono, descripción).
  - Gestión completa (CRUD) de su stock (con nombre, precio, foto/ilustración).
  - No puede verificarse sin suscripción.
- **Persona administradora**:
  - Gestión completa (CRUD) de tiendas y stock.

### Estudio de necesidades. Propuesta de valor respecto al mercado.

Servicios similares ya existentes:

- **Wallapop**: compra-venta pero de artículos de segunda mano, más bien se centra en encuentro directo comprador-vendedor y no en recogidas y envíos.
- **Glovo**: casi siempre ofrece solo envío, prioriza cadenas grandes y restaurantes.
- **Amazon, Temu y similares**: enfoque global, envíos más largos, puede resultar abrumador de gestionar según la demografía de la persona vendedora.
- **Uber Eats, Just Eat y similares**: pensados para envíos de comida a domicilio, sobretodo de restaurantes y cadenas de supermercados.
- **HIOPOS Galicia**: permite a comercios locales recibir pedidos online. Realmente es una plataforma de gestión pensada para empresas (servicio B2B, empresa a empresa). Sí que ofrecen una app (PortalRest) para mostrar el producto a la persona clienta final, pero es un servicio secundario para quien ya tenga HIOPOS contratado y no un marketplace libre donde la persona clienta puede buscar en varias tiendas. No destaca la opción de recogida en tienda, muy centrado en servicios de hostelería y sin un plan gratuito para las empresas.
- **D'Gusta Galicia**: sí está centrado en el envío de productos locales en Galicia, pero únicamente productos alimenticios típicos.
- **LoPróximo**: B2C orientado al comercio local. Realmente no ofrecen un marketplace como tal, si no atención a la persona clienta y detectores de demanda. Ahora mismo operan en la zona de Ourense.

### Personas destinatarias

- **Como personas vendedoras**: PYMES y autónomos de venta de productos en tiendas físicas que busquen expansión a venta online de manera fácil y asequible.
- **Como persona consumidora**: personas de clase media y mediana edad (estabilidad económica), concienciadas con respecto al consumo de producto local, el apoyo a pequeños locales, sentimiento de comunidad y similares. En esto se centrará el marketing (sig. punto).

### Promoción.

- **Anuncios y cuentas oficiales en YouTube y FaceBook**, especialmente al inicio, para mostrarla al mayor número de gente posible dentro de la demografía principal (punto anterior). Este punto y el uso de esas RRSS en concreto se debió a conclusiones propias posteriormente contrastadas con un estudio de IAB Spain que fue cubierto por RTVE. Según este, las usan el 90% de las personas españolas de 46 a 60 años y en ninguna otra franja baja del 80%. (https://iabspain.es/estudio/estudio-redes-sociales-2025-iab-spain/)
- **Carteles en los paneles de las paradas de bus** (el tamaño de estos captará la atención de l@s transeúntes), específicamente en calles concurridas de las localidades con mayor número de personas vendedoras/productos en la web.

### Modelo de negocio.

- **Sencillez y facilidad de uso**: La página será rápida, cómoda y de bajo coste de mantenimiento.
- **Modelo de registro gratuito**: Empresas y personas autónomas pueden registrarse sin coste si gestionan sus propios envíos.
- **Monetización**:
  - Pequeño % de cada compra.
  - Delegación de envíos.
  - Suscripción para destacar perfiles y obtener verificación.
- **Rentabilidad**: Se estima un margen significativo gracias a los servicios ofrecidos.

## Requisitos

- **Infraestructura**: acceso por url pública desde cualquier equipo a través de ngrok usando imágenes Docker de PHP, Laravel, Composer, gestor MariaDB, phpMyAdmin y servidor Apache
- **Backend**: PHP + Blade (framework Laravel)
- **Frontend**: JS, HTML, CSS
