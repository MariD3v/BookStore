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

    for (let i = 1; i < rows.length; i++) { // Empieza en 1 para omitir el encabezado
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