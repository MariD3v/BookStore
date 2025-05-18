<?php

include("getConnection.php");

session_start();

if (isset($_SESSION['logged_in'])) {
    header('location: perfil.php');
    exit();
}

if (isset($_POST['registrarse'])) {

    $client_nombre = $_POST['nombre'];
    $client_apellidos = $_POST['apellidos'];
    $client_email = $_POST['email'];
    $client_pass = $_POST['password'];
    $client_pass_conf = $_POST['password_conf'];

    $regex = '/^[A-z0-9._-]+@[A-z0-9][A-z0-9-]*(\.[A-z0-9_-]+)*\.([A-z]{2,6})$/';

    if (strlen($client_nombre) == 0 || strlen($client_apellidos) == 0 || strlen($client_email) == 0 || strlen($client_pass) == 0 || strlen($client_pass_conf) == 0) {
        header('location: registro.php?error=Rellena los campos vacíos');
        exit();
    } else if (!preg_match($regex, $client_email)) {
        header('Location: registro.php?error_email=Introduce una dirección de correo electrónico válida');
        exit();
    } else if (strlen($client_pass) < 6) {
        header('location: registro.php?error_pass=La contraseña debe contener 6 carácteres o más');
        exit();
    } else if ($client_pass !== $client_pass_conf) {
        header('location: registro.php?error_pass_conf=Las contraseñas no coinciden');
        exit();
    } else {
        $stmt1 = $conn->prepare("SELECT * FROM cliente WHERE email=?");
        $stmt1->bind_param('s', $client_email);
        $stmt1->execute();
        $stmt1->store_result();

        if ($stmt1->num_rows != 0) {
            header('Location: registro.php?error_email=Ya existe una cuenta registrada con este email');
            exit();
        } else {

            $client_pass = md5($client_pass);

            $stmt = $conn->prepare("INSERT INTO cliente (nombre,apellidos,email,contraseña) VALUES (?,?,?,?);");
            $stmt->bind_param('ssss', $client_nombre, $client_apellidos, $client_email, $client_pass);

            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;

                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $client_email;
                $_SESSION['user_name'] = $client_nombre;
                $_SESSION['user_surname'] = $client_apellidos;
                $_SESSION['logged_in'] = true;

                header('location:perfil.php');
                exit();
            } else {
                header('Location: registro.php?error=No se ha podido crear tu cuenta en este momento');
                exit();
            }
        }
    }
}
