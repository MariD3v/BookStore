<?php
include("getConnection.php");

if(isset($_GET["codigo_autor"])){

    $codigo_autor = $_GET["codigo_autor"];

    $stmt = $conn ->prepare("SELECT * FROM autor WHERE codigo_autor = ?"); //Obtener autor
    $stmt->bind_param("i",$codigo_autor);
    $stmt->execute();
    $autor_consulta = $stmt->get_result(); //Variable que guarda la consulta del autor

    if ($autor = $autor_consulta->fetch_assoc()) { //Obtener los resultados de autor, para poder trabajar con él 
        $stmt = $conn ->prepare("SELECT FLOOR(DATEDIFF(CURDATE(), fecha_nac) / 365) as edad FROM autor WHERE codigo_autor = ?"); //Obtener edad
        $stmt->bind_param("i",$codigo_autor);
        $stmt->execute();
        $autorEdad_consulta = $stmt->get_result();
        $autorEdad = $autorEdad_consulta->fetch_assoc();

        $stmt = $conn ->prepare("SELECT COUNT(codigo_libro) as nLibros FROM libro, autor WHERE libro.codigo_autor = autor.codigo_autor AND autor.codigo_autor = ? GROUP BY autor.codigo_autor "); //Obtener nº libros
        $stmt->bind_param("i",$codigo_autor);
        $stmt->execute();
        $autornlibros_consulta = $stmt->get_result();
        $autornlibros = $autornlibros_consulta->fetch_assoc();

        $stmt = $conn ->prepare("SELECT * FROM libro WHERE codigo_autor = ? LIMIT 12"); //Obtener libros para carrusel 
        $stmt->bind_param("i", $autor["codigo_autor"]);
        $stmt->execute();
        $librosAutor_consulta = $stmt->get_result(); 
    }

} else {
    header("location: ../index.php");
    exit();
}

$stmt->close();
$conn->close();
