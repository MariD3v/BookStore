function checkPayPal(preciototal) {
    paypal.Buttons({
        style: {
            layout: 'horizontal',
            color: 'blue',
            shape: 'rect',
            label: 'pay',
            tagline: false,
            height: 40
        },
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: preciototal
                    }
                }]
            });
        },
        onCancel: function (data) {
            console.log('Pago cancelado', data);
        },
        onApprove: async function (data, actions) {
            try {
                const details = await actions.order.capture();

                const response = await fetch('../server/orderPlaced.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'docompraformulariodefinitiva=1'
                });

                if (response.ok) {
                    window.location.href = 'compra-realizada.php?order_status=Compra realizada con éxito';
                } else {
                    console.error('Error en la respuesta del servidor');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        },
        onError: function (err) {
            console.error('An error occurred during the transaction', err);
            alert('Ocurrió un error durante la transacción. Por favor, inténtelo de nuevo.');
        }
    }).render('#paypal-button-container');
}