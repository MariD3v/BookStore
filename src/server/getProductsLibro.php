<?php
include("getConnection.php");

if(isset($_GET["codigo_libro"])){

    $codigo_libro = $_GET["codigo_libro"];

    $stmt = $conn ->prepare("SELECT * FROM libro WHERE codigo_libro = ?"); //Obtener libro
    $stmt->bind_param("i",$codigo_libro);
    $stmt->execute();
    $libro_consulta = $stmt->get_result(); //Variable que guarda la consulta del libro

    if ($libro = $libro_consulta->fetch_assoc()) { //Obtener los resultados de libro, para poder trabajar con él
        $codigo_autor = $libro["codigo_autor"];

        $stmt = $conn->prepare("SELECT * FROM autor WHERE codigo_autor = ?"); //Obtener autor
        $stmt->bind_param("i", $codigo_autor);
        $stmt->execute();
        $autor_consulta = $stmt->get_result(); //Variable que guarda la consulta del autor
        $autor = $autor_consulta -> fetch_assoc(); //Obtener los resultados de autor, para poder trabajar con él
        
        $stmt = $conn ->prepare("SELECT * FROM libro WHERE codigo_autor = ? AND codigo_libro != ? LIMIT 12"); //Obtener libros para carrusel (mismo autor)
        $stmt->bind_param("ii", $libro["codigo_autor"], $libro["codigo_libro"]);
        $stmt->execute();
        $librosAutor_consulta = $stmt->get_result(); //Obtener los resultados de los libros del mismo autor

        $stmt = $conn ->prepare("SELECT * FROM libro WHERE genero = ? AND codigo_libro != ? LIMIT 12"); //Obtener libros para carrusel (mismo genero)
        $stmt->bind_param("si", $libro["genero"], $libro["codigo_libro"]);
        $stmt->execute();
        $librosGenero_consulta = $stmt->get_result(); //Obtener los resultados de los libros del mismo género
    }

} else {
    header("location: ../index.php");
    exit();
}

$stmt->close();
$conn->close();