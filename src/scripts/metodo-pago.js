document.getElementById("formularioCompra").addEventListener("submit", function (event) {
    const radios = document.getElementsByName("payment_method");
    let isSelected = false;

    for (const radio of radios) {
        if (radio.checked) {
            isSelected = true;
            break;
        }
    }

    if (!isSelected) {
        event.preventDefault();
        const errorParagraph = document.querySelector(".pError");
        errorParagraph.textContent = "Por favor, selecciona un método de pago.";
        errorParagraph.style.color = "red";
    }
});