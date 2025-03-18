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