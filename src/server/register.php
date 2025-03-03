<?php

include("getConnection.php");

session_start();

if(isset($_SESSION['logged_in'])){ //Si ya estamos logeados en nuestra sesion
    header('location: perfil.php');
    exit();
}

if(isset($_POST['registrarse'])){ //Si pulsamos el boton registrarse

    // obtener los datos enviados en el form del registro
    $client_nombre = $_POST['nombre']; 
    $client_apellidos = $_POST['apellidos'];
    $client_email = $_POST['email'];
    $client_pass = $_POST['password'];
    $client_pass_conf = $_POST['password_conf'];

    //Validar los datos
    
    $regex = '/^[A-z0-9._-]+@[A-z0-9][A-z0-9-]*(\.[A-z0-9_-]+)*\.([A-z]{2,6})$/'; //Para validar email

    if (strlen($client_nombre) == 0 || strlen($client_apellidos) == 0 || strlen($client_email) == 0 || strlen($client_pass) == 0 || strlen($client_pass_conf) == 0){ //Comprobamos que no hay inputs vacios
        header('location: registro.php?error=Rellena los campos vacíos');
        exit();
    } else if (!preg_match($regex, $client_email)) { //Comprobamos que el email sea valido
        header('Location: registro.php?error_email=Introduce una dirección de correo electrónico válida');
        exit();
    } else if (strlen($client_pass) < 6){ //Comprobamos que la contraseña sea de almenos de 6 caracteres
        header('location: registro.php?error_pass=La contraseña debe contener 6 carácteres o más');
        exit();
    } else if ($client_pass!==$client_pass_conf){ //Comprobamos que la contraseña y la confirmada sean iguales
        header('location: registro.php?error_pass_conf=Las contraseñas no coinciden');
        exit();
    } else {  //Comprobamos que no exista ya un usuario con ese email
        $stmt1= $conn->prepare("SELECT * FROM cliente WHERE email=?"); 
        $stmt1->bind_param('s', $client_email);
        $stmt1->execute();
        $stmt1->store_result();
        
        if ($stmt1->num_rows != 0) {
            header('Location: registro.php?error_email=Ya existe una cuenta registrada con este email');
            exit();
        } else { //SI NO HAY ERRORES

            //Cifrar la contraseña
            $client_pass = md5($client_pass);

            //Insertar el usuario en la base de datos
            $stmt = $conn ->prepare("INSERT INTO cliente (nombre,apellidos,email,contraseña) VALUES (?,?,?,?);");
            $stmt->bind_param('ssss',$client_nombre,$client_apellidos,$client_email,$client_pass);
            
            if($stmt->execute()){ //Si se ha registrado correctamente, metemos en la sesion al usuario
                $user_id = $stmt->insert_id;

                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $client_email;
                $_SESSION['user_name'] = $client_nombre;
                $_SESSION['user_surname'] = $client_apellidos;
                $_SESSION['logged_in'] = true;

                header('location:perfil.php');
                exit();
            } else { //Si no se ha registrado correctamente
                header('Location: registro.php?error=No se ha podido crear tu cuenta en este momento');
                exit();
            }
        }
    }

}