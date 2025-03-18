<?php

include("getConnection.php");

session_start();

if (isset($_SESSION['logged_in'])) { //Si ya estamos logeados en nuestra sesion
    header('location: perfil.php');
    exit();
}

if (isset($_POST['iniciar_sesion'])) { //Si pulsamos el boton iniciar sesion

    // obtener los datos enviados en el form del inicio de sesión
    $client_email = $_POST['email'];
    $client_pass = $_POST['password'];

    if (strlen($client_email) == 0) { //Comprobamos que no metan el email vacio
        header('location: iniciar-sesion.php?errorEma=Introduce un email');
    } else if (strlen($client_pass) == 0) {  //Comprobamos que no metan la contraseña vacia
        header('location: iniciar-sesion.php?errorPass=Introduce una contraseña');
    } else {
        $stmt = $conn->prepare("SELECT codigo_cliente, nombre, apellidos, email, contraseña, administrador FROM cliente WHERE email = ? AND contraseña = ? LIMIT 1");

        $stmt->bind_param('ss', $client_email, md5($client_pass));

        if ($stmt->execute()) {
            $stmt->bind_result($codigo_cliente, $nombre, $apellidos, $email, md5($contraseña), $administrador);
            $stmt->store_result();

            if ($stmt->num_rows() == 1) {
                $row = $stmt->fetch();

                $_SESSION['user_id'] = $codigo_cliente;
                $_SESSION['user_name'] = $nombre;
                $_SESSION['user_surname'] = $apellidos;
                $_SESSION['user_email'] = $email;
                $_SESSION['administrador'] = $administrador;
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
