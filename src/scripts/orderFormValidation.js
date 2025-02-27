let formulario = document.getElementsByName("formulario")[0];

let nombre = document.getElementsByName("order_name")[0];
let apellidos = document.getElementsByName("order_surname")[0];
let email = document.getElementsByName("order_email")[0];
let telefono = document.getElementsByName("order_phone")[0];
let direccion = document.getElementsByName("order_direction")[0];
let direccion_adi = document.getElementsByName("order_direction_adicional")[0];
let codigo_postal = document.getElementsByName("order_postal_code")[0];
let poblacion = document.getElementsByName("order_town")[0];
let provincia = document.getElementsByName("order_city")[0];

let boton = document.getElementsByName("docompradefinitiva")[0];

let parrafos = document.getElementsByClassName("pError");

window.onload = function () {
    let expresionNomApe = /^[a-zA-ZÀ-ÿ\s]{2,50}$/;

    nombre.addEventListener("change", function () {
        if (nombre.value == "") {
            nombre.style.border = "1px solid red";
            parrafos[0].innerHTML = "Este campo no puede estar vacío";
        } else if (!expresionNomApe.test(nombre.value)) {
            nombre.style.border = "1px solid red";
            parrafos[0].innerHTML = "El nombre introducido no es válido";
        } else if (expresionNomApe.test(nombre.value)) {
            nombre.style.border = "none";
            parrafos[0].innerHTML = "";
        }
    })

    apellidos.addEventListener("change", function () {
        if (apellidos.value == "") {
            apellidos.style.border = "1px solid red";
            parrafos[1].innerHTML = "Este campo no puede estar vacío";
        } else if (!expresionNomApe.test(apellidos.value)) {
            apellidos.style.border = "1px solid red";
            parrafos[1].innerHTML = "Los apellidos introducidos no son válidos";
        } else if (expresionNomApe.test(apellidos.value)) {
            apellidos.style.border = "none";
            parrafos[1].innerHTML = "";
        }
    })

    let expresionEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    email.addEventListener("change", function () {

        if (email.value == "") {
            email.style.border = "1px solid red";
            parrafos[2].innerHTML = "Este campo no puede estar vacío";
        } else if (!expresionEmail.test(email.value)) {
            email.style.border = "1px solid red";
            parrafos[2].innerHTML = "El email introducido no es válido";
        } else if (expresionEmail.test(email.value)) {
            email.style.border = "none";
            parrafos[2].innerHTML = "";
        }
    })

    let expresionTel = /^\+?\d{1,4}[-.\s]?\d{1,4}(\s?\d{2,4}){2,4}$/

    telefono.addEventListener("change", function () {

        if (telefono.value == "") {
            telefono.style.border = "1px solid red";
            parrafos[3].innerHTML = "Este campo no puede estar vacío";
        } else if (!expresionTel.test(telefono.value)) {
            telefono.style.border = "1px solid red";
            parrafos[3].innerHTML = "El telefono introducido no es válido";
        } else if (expresionTel.test(telefono.value)) {
            telefono.style.border = "none";
            parrafos[3].innerHTML = "";
        }
    })

    let expresionDirec = /^[a-zA-Z0-9À-ÿ\s,.\-\/]{2,100}$/;

    direccion.addEventListener("change", function () {

        if (direccion.value == "") {
            direccion.style.border = "1px solid red";
            parrafos[4].innerHTML = "Este campo no puede estar vacío";
        } else if (!expresionDirec.test(direccion.value)) {
            direccion.style.border = "1px solid red";
            parrafos[4].innerHTML = "La dirección introducida no es válida";
        } else if (expresionDirec.test(direccion.value)) {
            direccion.style.border = "none";
            parrafos[4].innerHTML = "";
        }
    })

    direccion_adi.addEventListener("change", function () {

        if (direccion_adi.value == "") {
            direccion_adi.style.border = "1px solid red";
            parrafos[5].innerHTML = "Este campo no puede estar vacío";
        } else if (!expresionDirec.test(direccion_adi.value)) {
            direccion_adi.style.border = "1px solid red";
            parrafos[5].innerHTML = "La dirección introducida no es válida";
        } else if (expresionDirec.test(direccion_adi.value)) {
            direccion_adi.style.border = "none";
            parrafos[5].innerHTML = "";
        }
    })

    let expresionCodigo = /^\d{4,10}$/;

    codigo_postal.addEventListener("change", function () {

        if (codigo_postal.value == "") {
            codigo_postal.style.border = "1px solid red";
            parrafos[6].innerHTML = "Este campo no puede estar vacío";
        } else if (!expresionCodigo.test(codigo_postal.value)) {
            codigo_postal.style.border = "1px solid red";
            parrafos[6].innerHTML = "El código postal introducido no es válido";
        } else if (expresionCodigo.test(codigo_postal.value)) {
            codigo_postal.style.border = "none";
            parrafos[6].innerHTML = "";
        }
    })

    let expresionPoPro = /^[a-zA-ZÀ-ÿ\s]{2,50}$/;

    poblacion.addEventListener("change", function () {

        if (poblacion.value == "") {
            poblacion.style.border = "1px solid red";
            parrafos[7].innerHTML = "Este campo no puede estar vacío";
        } else if (!expresionPoPro.test(poblacion.value)) {
            poblacion.style.border = "1px solid red";
            parrafos[7].innerHTML = "La población introducida no es válida";
        } else if (expresionPoPro.test(poblacion.value)) {
            poblacion.style.border = "none";
            parrafos[7].innerHTML = "";
        }
    })

    provincia.addEventListener("change", function () {

        if (provincia.value == "") {
            provincia.style.border = "1px solid red";
            parrafos[8].innerHTML = "Este campo no puede estar vacío";
        } else if (!expresionPoPro.test(provincia.value)) {
            provincia.style.border = "1px solid red";
            parrafos[8].innerHTML = "La provincia introducida no es válida";
        } else if (expresionPoPro.test(provincia.value)) {
            provincia.style.border = "none";
            parrafos[8].innerHTML = "";
        }
    })

    formulario.addEventListener("submit", function (event) {
        if (nombre.value == "") {
            event.preventDefault();
            parrafos[0].innerHTML = "Este campo no puede estar vacío";
            nombre.style.border = "1px solid red";
        } else if (!expresionNomApe.test(nombre.value)) {
            event.preventDefault();
            nombre.style.border = "1px solid red";
            parrafos[0].innerHTML = "El nombre introducido no es válido";
        }

        if (apellidos.value == "") {
            event.preventDefault();
            parrafos[1].innerHTML = "Este campo no puede estar vacío";
            apellidos.style.border = "1px solid red";
        } else if (!expresionNomApe.test(apellidos.value)) {
            event.preventDefault();
            apellidos.style.border = "1px solid red";
            parrafos[1].innerHTML = "Los apellidos introducidos no son válidos";
        }

        if (email.value == "") {
            event.preventDefault();
            parrafos[2].innerHTML = "Este campo no puede estar vacío";
            email.style.border = "1px solid red";
        } else if (!expresionEmail.test(email.value)) {
            event.preventDefault();
            email.style.border = "1px solid red";
            parrafos[2].innerHTML = "El email introducido no es válido";
        }

        if (telefono.value == "") {
            event.preventDefault();
            parrafos[3].innerHTML = "Este campo no puede estar vacío";
            telefono.style.border = "1px solid red";
        } else if (!expresionTel.test(telefono.value)) {
            event.preventDefault();
            telefono.style.border = "1px solid red";
            parrafos[3].innerHTML = "El telefono introducido no es válido";
        }

        if (direccion.value == "") {
            event.preventDefault();
            parrafos[4].innerHTML = "Este campo no puede estar vacío";
            direccion.style.border = "1px solid red";
        } else if (!expresionDirec.test(direccion.value)) {
            event.preventDefault();
            direccion.style.border = "1px solid red";
            parrafos[4].innerHTML = "La dirección introducida no es válida";
        }

        if (direccion_adi.value == "") {
            event.preventDefault();
            parrafos[5].innerHTML = "Este campo no puede estar vacío";
            direccion_adi.style.border = "1px solid red";
        } else if (!expresionDirec.test(direccion_adi.value)) {
            event.preventDefault();
            direccion_adi.style.border = "1px solid red";
            parrafos[5].innerHTML = "La dirección introducida no es válida";
        }

        if (codigo_postal.value == "") {
            event.preventDefault();
            parrafos[6].innerHTML = "Este campo no puede estar vacío";
            codigo_postal.style.border = "1px solid red";
        } else if (!expresionCodigo.test(codigo_postal.value)) {
            event.preventDefault();
            codigo_postal.style.border = "1px solid red";
            parrafos[6].innerHTML = "El código postal introducido no es válido";
        }

        if (poblacion.value == "") {
            event.preventDefault();
            parrafos[7].innerHTML = "Este campo no puede estar vacío";
            poblacion.style.border = "1px solid red";
        } else if (!expresionPoPro.test(poblacion.value)) {
            event.preventDefault();
            poblacion.style.border = "1px solid red";
            parrafos[7].innerHTML = "La población introducida no es válida";
        }

        if (provincia.value == "") {
            event.preventDefault();
            parrafos[8].innerHTML = "Este campo no puede estar vacío";
            provincia.style.border = "1px solid red";
        } else if (!expresionPoPro.test(provincia.value)) {
            event.preventDefault();
            provincia.style.border = "1px solid red";
            parrafos[8].innerHTML = "La provincia introducida no es válida";
        }
    })
}
