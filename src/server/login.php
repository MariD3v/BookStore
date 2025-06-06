<?php

include("getConnection.php");

session_start();

if (isset($_SESSION['logged_in'])) {
    header('location: perfil.php');
    exit();
}

if (isset($_POST['iniciar_sesion'])) {

    $client_email = $_POST['email'];
    $client_pass = $_POST['password'];

    if (strlen($client_email) == 0) {
        header('location: iniciar-sesion.php?errorEma=Introduce un email');
        exit();
    } else if (strlen($client_pass) == 0) {
        header('location: iniciar-sesion.php?errorPass=Introduce una contraseña');
        exit();
    } else {
        $password_hashed = md5($client_pass);
        $stmt = $conn->prepare("SELECT codigo_cliente, nombre, apellidos, email, contraseña FROM cliente WHERE email = ? AND contraseña = ? LIMIT 1");
        $stmt->bind_param('ss', $client_email, $password_hashed);

        if ($stmt->execute()) {
            $stmt->bind_result($codigo_cliente, $nombre, $apellidos, $email, $contraseña_db);
            $stmt->store_result();

            if ($stmt->num_rows() == 1) {
                $stmt->fetch();

                $_SESSION['user_id'] = $codigo_cliente;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $nombre;
                $_SESSION['user_surname'] = $apellidos;
                $_SESSION['logged_in'] = true;

                header('location:perfil.php');
                exit();
            } else {
                header('location: iniciar-sesion.php?error=El email o contraseña introducido no es correcto');
                exit();
            }
        } else {
            header('location: iniciar-sesion.php?error=Algo ha ido mal');
            exit();
        }
    }
}
