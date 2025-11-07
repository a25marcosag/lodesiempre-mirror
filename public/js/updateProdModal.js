const $d = document,
    $btnsUpdateProd = $d
        .querySelector(".tarjetas")
        .querySelectorAll(".btn-update"),
    $formUpdate = $d.getElementById("formUpdateProd"),
    $formDelete = $d.getElementById("formDeleteProd"),
    $nombreForm = $d.getElementById("nombre_edit"),
    $precioForm = $d.getElementById("precio_edit"),
    $descForm = $d.getElementById("desc_edit");

$d.addEventListener("DOMContentLoaded", () => {
    $btnsUpdateProd.forEach((btn) => {
        btn.addEventListener("click", (ev) => {
            ev.preventDefault();

            const $idProd = btn.dataset.id,
                $nombreProd = btn.dataset.nombre,
                $precioProd = btn.dataset.precio,
                $descProd = btn.dataset.desc,
                $idTienda = btn.dataset.tienda;

            $nombreForm.value = $nombreProd;
            $precioForm.value = $precioProd;
            $descForm.value = $descProd;

            $formUpdate.action = `/producto/actualizar/${$idTienda}/${$idProd}`;
            $formDelete.action = `/producto/eliminar/${$idTienda}/${$idProd}`;

            window.popupUpdate.showModal();
        });
    });
});
