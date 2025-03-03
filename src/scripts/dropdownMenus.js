const allToggles = document.querySelectorAll('.dropdown-checkbox1, .dropdown-checkbox2, .dropdown-checkbox3, .dropdown-checkbox4, .dropdown-checkbox5');
const dropdowns = [
    {   // Mostrar libros/página
        options: document.querySelectorAll('.optionMostrarLxP'),
        selectedLabel: document.getElementById('selectedOptionMostrarLxP'),
        dropdownToggle: document.getElementById('dropdownToggle1'),
        dropdownMenu: document.querySelector('.dropdownmenu1')
    },
    {   // Ordenar por
        options: document.querySelectorAll('.optionOrdenarL'),
        selectedLabel: document.getElementById('selectedOptionOrdenarL'),
        dropdownToggle: document.getElementById('dropdownToggle2'),
        dropdownMenu: document.querySelector('.dropdownmenu2')
    }
];

// Cerrar menus
allToggles.forEach(toggle => {
    toggle.addEventListener('change', function(event) {
        allToggles.forEach(otherToggle => {
            if (otherToggle !== event.target) {
                otherToggle.checked = false;
            }
        });
    });
});

document.addEventListener('click', function(event) {
    allToggles.forEach(toggle => {
        const dropdownMenu = toggle.closest('.dropdownmenu');
        if (dropdownMenu && !dropdownMenu.contains(event.target)) {
            toggle.checked = false;
        }
    });

    dropdowns.forEach(({ dropdownToggle, dropdownMenu }) => {
        if (dropdownMenu && !dropdownMenu.contains(event.target)) {
            dropdownToggle.checked = false;
        }
    });
});

// Selección "Ordenar por" y "Mostrar libros/página"
dropdowns.forEach(({ options, selectedLabel, dropdownToggle }) => {
    options.forEach(option => {
        option.addEventListener('click', function(event) {
            selectedLabel.textContent = this.getAttribute('data-value'); 
            dropdownToggle.checked = false;
        });
    });
});

// Cargar la página y mostrar los valores de PHP
document.addEventListener('DOMContentLoaded', function() {
    dropdowns.forEach(({ selectedLabel }) => {
        const value = selectedLabel.getAttribute('data-value');
        if (value) {
            selectedLabel.textContent = value;
        }
    });
});