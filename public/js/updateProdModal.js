const $d = document,
    $btnsUpdateProd = $d
        .querySelector(".tarjetas")
        .querySelectorAll(".btn-update"),
    $formUpdate = $d.getElementById("formUpdateProd"),
    $formCleanImg = $d.querySelector(".btn-quitar-img-prod"),
    $nombreForm = $d.getElementById("nombre_edit"),
    $precioForm = $d.getElementById("precio_edit"),
    $descForm = $d.getElementById("desc_edit");

$d.addEventListener("DOMContentLoaded", () => {
    // vvv Este snippet no pertenece a la lógica de la ventana update producto: es de la vista principal vvv
    let preciosFueraModal = $d.querySelectorAll(".precio-tarjeta");
    preciosFueraModal.forEach((el) => {
        let precio = parseFloat(el.textContent);
        el.textContent = precio.toFixed(2) + " €";
    });

    function activarMiniatura(popup, input) {
        let miniatura = popup.querySelector(".imagen");

        input.addEventListener("change", () => {
            let file = input.files[0];

            let url = URL.createObjectURL(file);

            miniatura.style.backgroundImage = `url("${url}")`;
            miniatura.style.display = "block";
        });
    }

    let popupTienda = $d.querySelector("#popupTienda");
    let iconoTiendaForm = $d.getElementById("icono_tienda");
    let popupUpdateProd = $d.querySelector("#popupUpdate");
    let imagenUpdateProdForm = $d.getElementById("imagen_edit");
    let popupAddProd = $d.querySelector("#popupAdd");
    let imagenAddProdForm = $d.getElementById("imagen_nuevo");

    activarMiniatura(popupTienda, iconoTiendaForm);
    activarMiniatura(popupUpdateProd, imagenUpdateProdForm);
    activarMiniatura(popupAddProd, imagenAddProdForm);
    // ^^^ Fin del snippet ^^^

    $btnsUpdateProd.forEach((btn) => {
        btn.addEventListener("click", (ev) => {
            ev.preventDefault();

            const $idProd = btn.dataset.id,
                $nombreProd = btn.dataset.nombre,
                $precioProd = btn.dataset.precio,
                $descProd = btn.dataset.desc,
                $idTienda = btn.dataset.tienda,
                $imagenProd = btn.dataset.imagen;

            $nombreForm.value = $nombreProd;
            $precioForm.value = $precioProd;
            $descForm.value = $descProd;

            $formUpdate.action = `/producto/actualizar/${$idTienda}/${$idProd}`;

            if ($imagenProd) {
                popupUpdateProd.querySelector(
                    ".imagen"
                ).style.backgroundImage = `url("http://localhost/storage/img/${$imagenProd}")`;
                $formCleanImg.style.display = "block";
                $formCleanImg.action = `/producto/limpiar/imagen/${$idTienda}/${$idProd}`;
            } else {
                popupUpdateProd.querySelector(".imagen").style.backgroundImage =
                    "";
                $formCleanImg.style.display = "none";
            }

            window.popupUpdate.showModal();
        });
    });
});
