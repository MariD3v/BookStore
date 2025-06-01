<?php

include("getConnection.php");

session_start();

if(!isset($_SESSION['logged_in'])){ //Si no se ha iniciado sesión
    header('location: iniciar-sesion.php');
}

//Mostrar libros

$codigo_compra = $_GET["codigo_compra"];
$stmt = $conn->prepare("SELECT fecha FROM compra WHERE codigo_compra = ?");
$stmt->bind_param("i", $codigo_compra);
if ($stmt->execute()) {
    $stmt->bind_result($fecha_compra);
    if ($stmt->fetch()) {
    }
}

$stmt->close();

$stmt = $conn->prepare("SELECT libro.codigo_libro, libro.titulo, autor.nombre, libro.precio, detalle_compra.unidades, compra.fecha, detalle_compra.precio_unitario FROM compra JOIN detalle_compra ON compra.codigo_compra = detalle_compra.codigo_compra JOIN libro ON detalle_compra.codigo_libro = libro.codigo_libro JOIN autor ON libro.codigo_autor = autor.codigo_autor WHERE detalle_compra.codigo_compra = ?");
$stmt->bind_param("i", $codigo_compra);
if ($stmt->execute()){
    $pedido_detalles = $stmt->get_result();
} 

