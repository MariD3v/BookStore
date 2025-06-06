<?php

include("getConnection.php");

session_start();

if (!isset($_SESSION['logged_in'])) {
    header('location: iniciar-sesion.php');
    exit();
}


$codigo_usuario = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT compra.codigo_compra, compra.fecha, SUM(libro.precio * detalle_compra.unidades) AS total_compra, COUNT(detalle_compra.codigo_libro) AS total_articulos,MIN(detalle_compra.codigo_libro) AS primer_producto FROM compra JOIN detalle_compra ON compra.codigo_compra = detalle_compra.codigo_compra JOIN libro ON detalle_compra.codigo_libro = libro.codigo_libro WHERE compra.codigo_cliente = ? GROUP BY compra.codigo_compra");
$stmt->bind_param("i", $codigo_usuario);
$stmt->execute();
$compra_consulta = $stmt->get_result();

if (isset($_GET['cerrarsesion'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['user_id']);
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_surname']);

        header('location: iniciar-sesion.php');
        exit();
    }
}


if (isset($_POST['change_password'])) {

    $password = $_POST['password'];
    $passwordConf = $_POST['password_conf'];
    $email = $_SESSION['user_email'];

    if ($password != $passwordConf) {
        header('Location: perfil.php?error=Las contraseñas no coinciden');
        exit();
    } else if (strlen($password) < 6) {
        header('location: perfil.php?error=La contraseña debe contener 6 carácteres o más');
        exit();
    } else if (strlen($password) < 6) {
        header('location: perfil.php?error=La contraseña debe contener 6 carácteres o más');
        exit();
    } else {
        $password = md5($password);
        $stmt = $conn->prepare("UPDATE cliente SET contraseña = ? WHERE email = ?");
        $stmt->bind_param('ss', $password, $email);

        if ($stmt->execute()) {
            header('location: perfil.php?mensaje=Contraseña cambiada con éxito');
        } else {
            header('location: perfil.php?error=No se ha podido cambiar la contraseña');
        }
    }
}

function getRank($email)
{
    global $conn;

    $stmt = $conn->prepare("SELECT administrador FROM cliente WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($administrador);
    $stmt->store_result();
    $stmt->fetch();
    return $administrador;
}
