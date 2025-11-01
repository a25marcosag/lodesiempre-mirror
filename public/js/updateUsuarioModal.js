const $d = document,
    $btnsUpdate = $d.querySelectorAll(".btn-modal"),
    $formUpdate = $d.getElementById("formUpdate"),
    $formDelete = $d.getElementById("formDelete"),
    $nombreForm = $d.getElementById("nombre_edit"),
    $correoForm = $d.getElementById("correo_edit");

$d.addEventListener("DOMContentLoaded", () => {
    $btnsUpdate.forEach((btn) => {
        btn.addEventListener("click", (ev) => {
            ev.preventDefault();

            const $idUsuario = btn.dataset.id,
                $nombreUsuario = btn.dataset.nombre,
                $correoUsuario = btn.dataset.correo;

            $nombreForm.value = $nombreUsuario;
            $correoForm.value = $correoUsuario;

            $formUpdate.action = `/usuario/actualizar/${$idUsuario}`;
            $formDelete.action = `/usuario/eliminar/${$idUsuario}`;

            window.popup.showModal();
        });
    });
});
