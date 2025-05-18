<?php
include("getConnection.php");

session_start();

if (isset($_POST['add_product'])) { //comprobamos si hemos pulsado el boton de añadir producto
    if (isset($_SESSION['cart'])) { //comprobamos si ya habian mas libros en el carro en nuestra sesion

        $products_array_ids = array_column($_SESSION['cart'], "product_id"); // array con todos los ids de los productos que habian en el carro
        $product_id = $_POST['product_id'];
        if (!in_array($product_id, $products_array_ids)) { //Si el producto no estaba en el carro todavia
            //obtenemos los datos del form y lo metemos en el array
            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_author' => $_POST['product_author'],
                'product_quantity' => $_POST['product_quantity'],
                'activado' => checkStatus($_POST['product_id']) // Guardamos el valor aquí
            );

            $_SESSION['cart'][$product_id] = $product_array; //metemos el producto en nuestra sesion cart. $product_id] = $product_array significa = (1 => '1','Trono de cristal',20.00,1)

        } else { //Si el producto ya estaba en el carro
            //no hacemos nada
        }
    } else { //si es el primer producto en nuestra sesion

        $product_id = $_POST['product_id']; // obtenemos los datos enviados en el form
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];
        $product_author = $_POST['product_author'];
        $activado = checkStatus($product_id);

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_author' => $product_author,
            'product_quantity' => $product_quantity,
            'activado' => checkStatus($product_id) // Guardamos el valor aquí
        );

        $_SESSION['cart'][$product_id] = $product_array; //metemos el producto en nuestra sesion cart. $product_id] = $product_array significa = (1 => '1','Trono de cristal',20.00,1)
    }

    calculateTotal();
} else if (isset($_POST['remove_product'])) { //comprobamos si hemos pulsado el boton de eliminar producto

    $product_id = $_POST['product_id']; //Obtenemos el id del producto a eliminar
    unset($_SESSION['cart'][$product_id]);
    calculateTotal();
} else if (isset($_POST['more_product'])) {

    $product_id = $_POST['product_id']; //Obtenemos el id del producto a eliminar
    $product_array = $_SESSION['cart'][$product_id]; //Obtenemos el array del producto

    $product_array['product_quantity'] = (int)$product_array['product_quantity'] + 1; //cambiamos la cantidad del array
    $_SESSION['cart'][$product_id] = $product_array; //metemos el array en la sesion
    calculateTotal();
} else if (isset($_POST['less_product'])) {

    $product_id = $_POST['product_id']; //Obtenemos el id del producto a eliminar
    $product_array = $_SESSION['cart'][$product_id]; //Obtenemos el array del producto

    if ($product_array['product_quantity'] > 1) {
        $product_array['product_quantity'] = (int)$product_array['product_quantity'] - 1; //cambiamos la cantidad del array
        $_SESSION['cart'][$product_id] = $product_array; //metemos el array en la sesion    
    }
    calculateTotal();
}

function calculateTotal()
{
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $total += $product['product_quantity'] * $product['product_price'];
    }
    $_SESSION['total'] = $total;
}


function checkStatus($codigo_libro)
{
    global $conn;
    $sql = "SELECT activado FROM libro WHERE codigo_libro = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo_libro);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['activado'];
    } else {
        return false;
    }
}
