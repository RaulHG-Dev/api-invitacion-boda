import axios from "axios";
import DataTable from "datatables.net-dt";
import "datatables.net-dt/css/dataTables.dataTables.css";
import Swal from "sweetalert2";

document.addEventListener('DOMContentLoaded', () => {
    let table = new DataTable('#invitados', {
        ordering: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json',
        },
    });
});

document.getElementById('form-invitado').addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    Swal.fire({
        title: 'Registrando, espere...'
    });
    Swal.showLoading();
    axios.post('/invitados', formData)
        .then(({data}) => {
            console.log(data);
            if(data.status) {
                Swal.fire({
                    title: '¡Se registró correctamente!',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    location.reload();
                });
            } else {

            }
        })
        .catch((error) => {
            console.log(error);

        });
});
