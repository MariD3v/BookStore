const toggleButton = document.getElementById("toggle-btn");
const sidebar = document.getElementById("sidebar");

function toggleSidebar() {
    sidebar.classList.toggle("close");
    toggleButton.classList.toggle("rotate");

    Array.from(sidebar.getElementsByClassName('show')).forEach(subMenu => {
        subMenu.classList.remove("show");
        subMenu.previousElementSibling.classList.remove("rotate");
    });
}

function toggleSubMenu(boton) {

    boton.nextElementSibling.classList.toggle("show");
    boton.classList.toggle("rotate");

    if (sidebar.classList.contains("close")) {
        sidebar.classList.toggle("close");
        toggleButton.classList.toggle("rotate");
    }

}


function topbarSubMenu(evento, boton) {
    if (evento) evento.stopPropagation();
    var menu = document.getElementById("dropdownMenu");

    menu.classList.toggle("show");
    boton.classList.toggle("rotate");

}

document.addEventListener("click", function (event) {
    var menu = document.getElementById("dropdownMenu");
    var button = document.querySelector(".topbar .dropdown-btn");

    if (!menu.contains(event.target) && !button.contains(event.target)) {
        menu.classList.remove("show");
        button.classList.remove("rotate");
    }
});

function searchUser() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toLowerCase();
    const table = document.getElementsByClassName("table-container")[0];
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let match = false;

        for (let j = 0; j < cells.length; j++) {
            if (cells[j]) {
                const text = cells[j].textContent || cells[j].innerText;
                if (text.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
        }

        rows[i].style.display = match ? "" : "none";
    }
}

function searchProducts() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toLowerCase();
    const table = document.getElementsByClassName("table-container")[0];
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let match = false;

        for (let j = 0; j < cells.length; j++) {
            if (cells[j]) {
                const text = cells[j].textContent || cells[j].innerText;
                if (text.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
        }

        rows[i].style.display = match ? "" : "none";
    }
}


// Editar esto
function verDescripcionLibro(descripcion) {
    console.log(descripcion)
}

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const userId = this.getAttribute('data-user-id');
            const userEmail = this.getAttribute('data-user-email');
            const userSurnames = this.getAttribute('data-user-surnames');
            const userName = this.getAttribute('data-user-name');

            const confirmation = confirm(`¿Seguro que quieres eliminar al usuario "${userName} ${userSurnames}"?`);
            if (!confirmation) return;

            try {
                const response = await fetch(`../server/deleteUsers.php?userId=${userId}&email=${encodeURIComponent(userEmail)}&action=deleteUser`, {
                    method: 'DELETE',
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    alert(`Usuario "${userName} ${userSurnames}" eliminado correctamente.`);
                    this.closest('tr').remove();
                } else {
                    alert('Error al eliminar el usuario. Inténtalo de nuevo más tarde.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error en la comunicación con el servidor.');
            }
        });
    });
});



function verDetallePedido(orderId) {
    const verDetalleButtons = document.querySelectorAll('.ver-detalle-btn');
    verDetalleButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const orderId = this.getAttribute('data-codigo-compra');

            try {
                const response = await fetch(`../server/getOrdersById.php?orderId=${orderId}`, {
                    method: 'GET',
                });

                if (response.ok) {
                    const data = await response.json();

                    if (data.success) {
                        mostrarDetallesPedido(data.orderDetails, data.total);
                    } else {
                        alert('No se encontraron detalles de la compra.');
                    }
                } else {
                    alert('Error al obtener los detalles del pedido.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error en la comunicación con el servidor.');
            }
        });
    });
}

function mostrarDetallesPedido(orderDetails, total) {
    const modal = document.getElementById('orderModal-container');
    const tableBody = document.getElementById('orderModal-table-body');
    const totalSpan = document.getElementById('orderModal-total-price');

    const nombre = document.getElementById('orderModal-customer-nombre');
    const apellidos = document.getElementById('orderModal-customer-apellidos');
    const estado = document.getElementById('orderModal-customer-estado');

    modal.classList.remove('close');
    modal.classList.add('show');

    if (!orderDetails.length) return;

    nombre.textContent = orderDetails[0].nombre || '';
    apellidos.textContent = orderDetails[0].apellidos || '';
    estado.textContent = orderDetails[0].estado || '';

    tableBody.innerHTML = '';

    orderDetails.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
        <td>${product.codigo_libro}</td>
        <td>${product.titulo}</td>
        <td>${product.unidades}</td>
        <td>${parseFloat(product.precio).toFixed(2)} €</td>
        <td>${parseFloat(product.total_producto).toFixed(2)} €</td>
      `;
        tableBody.appendChild(row);
    });

    totalSpan.textContent = parseFloat(total).toFixed(2);

    // Mostrar modal con animación
    modal.classList.remove('close');
    modal.classList.add('show');

    // Cerrar con botón
    modal.querySelector('.orderModal-close').onclick = () => {
        modal.classList.remove('show');
        modal.classList.add('close');
    };

    // Cerrar al hacer clic fuera del contenido
    window.onclick = e => {
        if (e.target === modal) {
            modal.classList.remove('show');
            modal.classList.add('close');
        }
    };
}

verDetallePedido()