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


function topbarSubMenu(event, boton) {
    if (event) event.stopPropagation();
    var menu = document.getElementById("dropdownMenu");
    var sidebar = document.getElementById("sidebar");
    var toggleButton = document.getElementById("toggle-btn");

    menu.classList.toggle("show");
    boton.classList.toggle("rotate");

    if (sidebar && sidebar.classList.contains("close")) {
        sidebar.classList.toggle("close");
        toggleButton.classList.toggle("rotate");
    }
}

document.addEventListener("click", function (event) {
    var menu = document.getElementById("dropdownMenu");
    var button = document.querySelector(".dropdown-btn");

    if (!menu.contains(event.target) && !button.contains(event.target)) {
        menu.classList.remove("show");
        button.classList.remove("rotate");
    }
});
