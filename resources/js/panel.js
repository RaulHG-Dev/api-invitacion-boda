import axios from "axios";
import DataTable from "datatables.net-dt";
import "datatables.net-dt/css/dataTables.dataTables.css";
import Swal from "sweetalert2";
import {
    Modal
} from "flowbite";

const BUTTON = 'BUTTON';
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

document.addEventListener('DOMContentLoaded', () => {
    let table = new DataTable('#invitados', {
        ordering: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json',
        },
        columnDefs: [{
            className: 'dt-center',
            targets: [1]
        }],
        columns: [{
            width: '50%'
        }, {
            width: '30%'
        }, {
            width: '20%'
        }]
    });
});

document.addEventListener('click', (e) => {
    if (e.target.nodeName === BUTTON) {
        if (e.target.classList.contains('btn-edit')) {
            editEvent(e);
        } else if (e.target.classList.contains('btn-delete')) {
            deleteEvent(e);
        } else if (e.target.classList.contains('btn-close-medit')) {
            const modal = getModal();
            modal.hide();
        }
    }
});

document.getElementById('form-invitado').addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    Swal.fire({
        title: 'Registrando, espere...'
    });
    Swal.showLoading();
    axios.post('./invitados', formData)
        .then(({
            data
        }) => {
            if (data.status) {
                Swal.fire({
                    title: '¡Se registró correctamente!',
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                    confirmButtonText: 'Aceptar',
                }).then(() => {
                    location.reload();
                });
            } else {
                Toast.fire({
                    icon: "info",
                    title: "Ocurrió un problema al registrar invitado, intenta de nuevo."
                });
            }
        })
        .catch((error) => {
            Toast.fire({
                icon: "info",
                title: "Ocurrió un problema al registrar invitado, intenta de nuevo."
            });
        });
});

document.getElementById('form-edit-invitado').addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    Swal.fire({
        title: 'Actualizando, espere...'
    });
    Swal.showLoading();
    // for (const value of formData.values()) {
    //     console.log(value);
    //   }
    axios.post('./invitados/actualizar', formData)
        .then(({
            data
        }) => {
            if (data.status) {
                Swal.fire({
                    title: '¡Se actualizó correctamente!',
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                    confirmButtonText: 'Aceptar',
                }).then(() => {
                    location.reload();
                });
            } else {
                Toast.fire({
                    icon: "info",
                    title: "Ocurrió un problema al actualizar invitado, intenta de nuevo."
                });
            }
        })
        .catch((error) => {
            Toast.fire({
                icon: "info",
                title: "Ocurrió un problema al actualizar invitado, intenta de nuevo."
            });
        });
});
const editEvent = (e) => {
    const {
        uuid
    } = e.target.dataset;

    Swal.fire({
        title: 'Obteniendo información, espere...'
    });
    Swal.showLoading();

    axios.get(`./invitados/${uuid}`)
        .then(({
            data
        }) => {
            if (data.status) {
                const {
                    data: data_modal
                } = data;
                // Get inputs
                const input_uuid = document.getElementById('uuid_invitado');
                const input_nombre = document.getElementById('nombre_invitado_edit');
                const input_cantidad = document.getElementById('cantidad_invitados_edit');
                // Set values
                input_uuid.value = data_modal.uuid_invitado;
                input_nombre.value = data_modal.nombre_invitado;
                input_cantidad.value = data_modal.numero_invitados;
                // Open modal
                Swal.close();
                const modal = getModal();
                modal.show();
            } else {
                Toast.fire({
                    icon: "info",
                    title: "Ocurrió un problema al obtener información de invitado, intenta de nuevo."
                });
            }
        })
        .catch((error) => {
            Toast.fire({
                icon: "info",
                title: "Ocurrió un problema al obtener información de invitado, intenta de nuevo."
            });
        });
}

const getModal = () => {
    const $targetEl = document.getElementById('default-modal-edit', {
        closable: true
    });
    const modal = new Modal($targetEl);
    return modal;
}
/**
 * The `deleteEvent` function prompts the user to confirm deletion of a record and then calls a
 * function to delete the record if confirmed.
 * @param e - The `e` parameter in the `deleteEvent` function is typically an event object that is
 * passed when the function is called in response to an event, such as a click event. In this case, it
 * is used to access the `uuid` property from the `dataset` of the target element
 */
const deleteEvent = (e) => {
    const {
        uuid
    } = e.target.dataset;

    Swal.fire({
        title: "¿Desea eliminar este registro?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Sí, eliminar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Eliminando registro...',
                allowEscapeKey: false,
                allowOutsideClick: false
            });
            Swal.showLoading();
            eliminarRegistro(uuid);
        }
    });
}

/**
 * The function `eliminarRegistro` sends a DELETE request to remove a guest record and displays a
 * success message or an error message accordingly.
 * @param uuid - The `uuid` parameter in the `eliminarRegistro` function is a unique identifier for the
 * record of the guest that you want to delete from the database. It is used to specify which guest
 * record should be deleted when making a DELETE request to the server.
 */
const eliminarRegistro = (uuid) => {
    axios.delete(`./invitados/${uuid}`)
        .then(({
            data
        }) => {
            if (data.status) {
                Swal.fire({
                    title: 'Eliminado correctamente',
                    timer: 3000,
                    timerProgressBar: true,
                    confirmButtonText: 'Aceptar',
                }).then(() => {
                    location.reload();
                });
            } else {
                Toast.fire({
                    icon: "info",
                    title: "Ocurrió un problema al eliminar invitado, intenta de nuevo."
                });
            }
        })
        .catch(() => {
            Toast.fire({
                icon: "info",
                title: "Ocurrió un problema al eliminar invitado, intenta de nuevo."
            });
        })
}
