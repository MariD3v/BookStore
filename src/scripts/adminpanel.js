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
    document.querySelectorAll('.delete-btn-product').forEach(btn => {
        btn.addEventListener('click', () => {
            const codigoLibro = btn.getAttribute('data-codigo-libro');

            if (!codigoLibro) {
                alert('Código del libro no encontrado.');
                return;
            }

            if (confirm('¿Estás seguro de que deseas eliminar este libro?')) {
                fetch('../server/deleteLibro.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `codigo_libro=${codigoLibro}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Libro eliminado correctamente.');
                            location.reload();
                        } else {
                            alert('Error al eliminar el libro: ' + (data.message || 'Error desconocido.'));
                        }
                    })
                    .catch(error => {
                        console.error('Error en la solicitud:', error);
                        alert('Error al comunicarse con el servidor.');
                    });
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

    modal.classList.remove('close');
    modal.classList.add('show');

    modal.querySelector('.orderModal-close').onclick = () => {
        modal.classList.remove('show');
        modal.classList.add('close');
    };

    window.onclick = e => {
        if (e.target === modal) {
            modal.classList.remove('show');
            modal.classList.add('close');
        }
    };
}

verDetallePedido()


function verDetalleLibroParaEditar(libroId) {
    const verDetalleButtons = document.querySelectorAll('.editar-modal-btn');
    verDetalleButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const libroId = this.getAttribute('data-codigo-libro');

            try {
                const response = await fetch(`../server/getLibrobyId.php?libroId=${libroId}`, {
                    method: 'GET',
                });

                if (response.ok) {
                    const data = await response.json();

                    console.log(data);

                    if (data.success) {
                        mostrarFormularioEdicionLibro(data.libroDetails);
                    } else {
                        alert('No se encontraron detalles del libro.');
                    }
                } else {
                    alert('Error al obtener los datos del libro.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error en la comunicación con el servidor.');
            }
        });
    });
}

function mostrarFormularioEdicionLibro(libro) {
    const modal = document.getElementById('editBookModal-container');

    document.getElementById('edit-codigo_libro').value = libro.codigo_libro || '';
    document.getElementById('edit-titulo').value = libro.titulo || '';
    document.getElementById('edit-genero').value = libro.genero || '';
    document.getElementById('edit-editorial').value = libro.editorial || '';
    document.getElementById('edit-n_pag').value = libro.n_pag || '';
    document.getElementById('edit-idioma').value = libro.idioma || 'Español';
    document.getElementById('edit-fecha_publ').value = libro.fecha_publ || '';
    document.getElementById('edit-encuadernacion').value = libro.encuadernacion || 'Tapa blanda';
    document.getElementById('edit-precio').value = libro.precio || '';
    document.getElementById('edit-descripcion_libro').value = libro.descripcion_libro || '';
    document.getElementById('edit-serie').value = libro.serie || '';
    document.getElementById('edit-numero').value = libro.numero || '';
    document.getElementById('edit-codigo_autor').value = libro.codigo_autor || '';
    document.getElementById('edit-activado').value = libro.activado;
    console.log(libro.activado);

    modal.classList.remove('close');
    modal.classList.add('show');

    modal.querySelector('.editBookModal-close').onclick = () => {
        modal.classList.remove('show');
        modal.classList.add('close');
    };

    window.onclick = e => {
        if (e.target === modal) {
            modal.classList.remove('show');
            modal.classList.add('close');
        }
    };

    modal.querySelector('.editBookModal-cancel').onclick = () => {
        modal.classList.remove('show');
        modal.classList.add('close');
    };
}

verDetalleLibroParaEditar();


function guardarLibro() {
    const form = document.getElementById('editBookForm');
    const modal = document.getElementById('editBookModal-container');

    if (!form) {
        alert('Formulario no encontrado.');
        return;
    }

    const formData = new FormData(form);

    let precio = formData.get('precio');
    if (precio) {
        precio = precio.replace(',', '.');
        formData.set('precio', precio);
    }

    fetch('../server/updateLibro.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Libro actualizado correctamente.');
                modal.classList.remove('show');
                modal.classList.add('close');

                location.reload();
            } else {
                alert('Error al actualizar: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error al guardar el libro:', error);
            alert('Error en la comunicación con el servidor.');
        });
}

function abrirModalNuevoLibro() {
    const modal = document.getElementById('updateBookModal-container');
    const form = document.getElementById('updateBookForm');

    if (!modal || !form) {
        console.error('Modal o formulario no encontrado.');
        return;
    }

    form.reset();

    modal.classList.remove('close');
    modal.classList.add('show');

    modal.querySelector('.updateBookModal-close').onclick = () => {
        modal.classList.remove('show');
        modal.classList.add('close');
    };

    window.onclick = (e) => {
        if (e.target === modal) {
            modal.classList.remove('show');
            modal.classList.add('close');
        }
    };

    const cancelBtn = modal.querySelector('.updateBookModal-cancel');
    if (cancelBtn) {
        cancelBtn.onclick = () => {
            modal.classList.remove('show');
            modal.classList.add('close');
        };
    }
}

function insertarLibro() {
    const form = document.getElementById('updateBookForm');
    const modal = document.getElementById('updateBookModal-container');

    if (!form) {
        alert('Formulario no encontrado.');
        return;
    }

    const formData = new FormData(form);

    // Validar campos obligatorios
    const camposObligatorios = [
        'titulo',
        'genero',
        'editorial',
        'n_pag',
        'idioma',
        'fecha_publ',
        'encuadernacion',
        'precio',
        'descripcion_libro',
        'serie',
        'numero',
        'codigo_autor',
        'activado',
    ];

    for (const campo of camposObligatorios) {
        const valor = formData.get(campo);
        if (!valor || valor.trim() === '') {
            alert(`Por favor, completa el campo: ${campo}`);
            return;
        }
    }

    let precio = formData.get('precio');
    if (precio) {
        precio = precio.replace(',', '.');
        formData.set('precio', precio);
    }

    fetch('../server/insertLibro.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Libro insertado correctamente.');
                modal.classList.remove('show');
                modal.classList.add('close');
                location.reload();
            } else {
                alert('Error al insertar: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error al guardar el libro:', error);
            alert('Error en la comunicación con el servidor.');
        });
}

