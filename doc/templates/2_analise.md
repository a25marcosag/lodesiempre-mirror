# Análisis: Requisitos del sistema

## Descripción general

**LoDeSiempre** es una web responsive de compra-venta de productos locales con el propósito de poner en contacto a personas vendedoras con personas consumidoras, en un inicio con rango de operación en las provincias de A Coruña y Pontevedra.<br>

Las personas consumidoras podrán **consultar catálogos** de tiendas locales y **añadir/quitar sus productos en un carrito de compras digital** para posteriormente realizar **pedidos de recogida en tienda o de entrega a domicilio** (esto último requiere sesión iniciada). Las personas vendedoras podrán **registrar su tienda, modificar su perfil y gestionar sus productos**. El equipo administrador de la web podrá **supervisar y gestionar todos los tipos de cuentas y los stocks de productos** mediante una interfaz administrativa.<br>

El objetivo principal de LoDeSiempre es **fomentar el comercio local facilitando la experiencia de compra de la persona usuaria y posicionándose como alternativa a multinacionales de venta global**.

## Funcionalidades

Las funcionalidades del sistema con número identificativo y clasificadas según:

**Actor persona anónima sin cuenta**

#1: Crear cuenta, iniciar sesión

#2: Consultar lista tiendas con buscador y con filtro, clicar una tienda lleva al #3 y #4

#3: Consultar info. de una tienda

#4: Consultar lista productos de una tienda con buscador y con filtro

#5: Opción de añadir al carrito en cada producto del #4

#6: Consultar su carrito propio y gestionar sus productos (+1ud, -1ud, quitar)

#7: Elegir tipo de envío (en tienda o a domicilio) y comprar, lleva al #1

**Actor persona consumidora**

#2: Consultar lista tiendas con buscador y con filtro, clicar una tienda lleva al #3 y #4

#3: Consultar info. de una tienda

#4: Consultar lista productos de una tienda con buscador y con filtro

#5: Opción de añadir al carrito en cada producto del #4

#6: Consultar su carrito propio y gestionar sus productos (+1ud, -1ud, quitar)

#7: Elegir tipo de envío (en tienda o a domicilio) y comprar

#8: Cerrar sesión

**Actor persona vendedora**

#3: Consultar info. de su tienda

#4: Consultar lista productos de su tienda con buscador y con filtro

#8: Cerrar sesión

#9: Editar sus atributos (nombre, provincia, icono, descripción) excepto el de verificación desde el #3

#10: Gestionar sus productos (CRUD completo) desde el #4

#11: Solicitar verif. (si no la tiene), cancelar verif.

**Actor admin.**

#2: Consultar lista tiendas con buscador y con filtro, clicar en una tienda lleva al #3 y #4

#3: Consultar info. de una tienda

#4: Consultar lista productos de una tienda con buscador y con filtro

#8: Cerrar sesión

#10: Gestionar productos (CRUD completo) desde el #4

#12: Gestión de tienda (CRUD completo) desde el #3

#13: Consultar lista de todos los tipos de usuarios con buscador y con filtro

#14: Gestionar usuarios (CRUD completo) desde el #13

## Tipos de usuarios

- **Usuari@ anónim@**: navegación por la lista de tiendas y las listas de stock, pero sin poder comprar.

- **Usuari@ consumidor/a**: cliente final que consulta la lista de tiendas cada una con su lista de stock que luego puede comprar.

- **Usuari@ vendedor/a**: gestión de su tienda y productos.

- **Usuari@ admin.**: gestión completa (CRUD) sobre productos y usuarios del sistema.

## Normativa

La web, al operar dentro de España, se tendrá que adherir a la legislación vigente sobre protección de datos: la [**Ley Orgánica 3/2018** de 5 de diciembre de **Protección de Datos Personales y garantía de los derechos digitales** (LOPDPGDD)](https://www.boe.es/buscar/act.php?id=BOE-A-2018-16673).<br>

Para cumplir esta normativa, tanto en el footer como al entrar sin cuenta o al crearse una nueva se proporcionarán:

- **Aviso legal**: identificación de la persona responsable del tratamiento de los datos.

- **Política de privacidad**: explicación de los datos recogidos y con qué finalidad, además de como se tratarán, cuanto se retendrán y como eliminarlos si así se desea.

- **Política de cookies**: información sobre las cookies usadas en la web.

Esta información estará a disposición de la persona usuaria en el footer. También se mostrará al entrar de manera anónima o al crear una cuenta nueva para pedir un **consentimiento explícito** (por ejemplo con un checkbox o aceptando un popup).
