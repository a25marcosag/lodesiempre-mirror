const $d = document,
    $listaProd = $d.querySelector(".tarjetas"),
    $precioTotal = $d.querySelector(".precio-total");

let urlProductos = "/carrito/listar/json";

const productos = [];

function ajax(options) {
    const { url, method, fSuccess, fError, data } = options;

    fetch(url, {
        method: method || "GET",
        headers: {
            "Content-type": "application/json; charset:utf-8",
            "X-CSRF-TOKEN": $d.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify(data),
    })
        .then((resp) => (resp.ok ? resp.json() : Promise.reject(resp)))
        .then((json) => fSuccess(json))
        .catch((error) => fError(error));
}

function getData() {
    fetch(urlProductos)
        .then((resp) => (resp.ok ? resp.json() : Promise.reject(resp)))
        .then((prods) => {
            productos.splice(0, productos.length, ...prods);
            renderProductos(productos);
        })
        .catch((errors) => console.log(errors));
}

function renderProductos(productos) {
    let total = 0;
    $listaProd.innerHTML = productos.reduce((anterior, actual, i) => {
        total += actual.cantidad * actual.precio;
        let urlImagenProd = actual.imagen
            ? `<span class="imagen" style="background-image: url('/storage/img/${actual.imagen}');"></span>`
            : "";
        return (
            anterior +
            `<li class="tarjeta" title="tarjeta" data-id="${actual.id}">
                <h2>${i + 1}. ${actual.nombre} x${actual.cantidad}</h2>
                <p>${(actual.precio * actual.cantidad).toFixed(2)} € (${
                actual.precio
            } €/Ud.)</p>
                ${actual.descripcion ? `<p>${actual.descripcion}</p>` : ""}
                ${urlImagenProd}
                <p class="btns-prod-cart">
                    <a href="#" class="btn-sumar" aria-label="Sumar una unidad a ${
                        actual.nombre
                    }" data-id="${actual.id}">+</a>
                    <a href="#" class="btn-restar" aria-label="Restar una unidad a ${
                        actual.nombre
                    }" data-id="${actual.id}">-</a>
                </p>
            </li>`
        );
    }, "");
    $precioTotal.innerHTML = total.toFixed(2);
}

function actualizarProducto(producto, cantidad) {
    ajax({
        url: `${urlProductos}/${producto.id}`,
        method: "PATCH",
        fSuccess: (json) => {
            producto.cantidad = json.cantidad;
            if (producto.cantidad == 0) {
                borrarProducto(producto.id);
            } else {
                renderProductos(productos);
            }
        },
        fError: (error) => console.log(error),
        data: { cantidad: producto.cantidad + cantidad },
    });
}

function borrarProducto(id) {
    ajax({
        url: `${urlProductos}/${id}`,
        method: "DELETE",
        fSuccess: (json) => {
            let i = productos.findIndex((el) => el.id == id);
            productos.splice(i, 1);
            renderProductos(productos);
        },
        fError: (error) => console.log(error),
    });
}

$listaProd.addEventListener("click", (ev) => {
    ev.preventDefault();
    let id = ev.target.dataset.id;

    if (id) {
        const producto = productos.find((el) => el.id == id);

        if (ev.target.classList.contains("btn-sumar")) {
            actualizarProducto(producto, 1);
        } else if (ev.target.classList.contains("btn-restar")) {
            actualizarProducto(producto, -1);
        }
    }
});

$d.addEventListener("DOMContentLoaded", getData);
