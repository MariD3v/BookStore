<?php
include("getConnection.php");

$selectedGenres = isset($_GET['genero']) ? $_GET['genero'] : [];
$selectedLanguage = isset($_GET['idioma']) ? $_GET['idioma'] : [];
$selectedPriceMin = isset($_GET['valorpreciomin']) ? $_GET['valorpreciomin'] : '';
$selectedPriceMax = isset($_GET['valorpreciomax']) ? $_GET['valorpreciomax'] : '';
$selectedOrder = isset($_GET['valororden']) ? $_GET['valororden'] : 'Relevancia';
$selectedDisplay = isset($_GET['valorLxP']) ? $_GET['valorLxP'] : '10';
$valueSearchBar = isset($_GET['searchBar']) ? $_GET['searchBar'] : '';
$contador = isset($_GET['contador']) ? (int)$_GET['contador'] : 1;

$sql = "SELECT * FROM libro, autor WHERE libro.codigo_autor=autor.codigo_autor";

if (!empty($selectedGenres)) {
    $genresPlaceholder = implode(',', array_fill(0, count($selectedGenres), '?'));
    $sql .= " AND genero IN ($genresPlaceholder)";
}

if (!empty($selectedLanguage)) {
    $languagePlaceholder = implode(',', array_fill(0, count($selectedLanguage), '?'));
    $sql .= " AND idioma IN ($languagePlaceholder)";
}

if ($selectedPriceMin !== '') {
    $sql .= " AND precio >= ?";
}

if ($selectedPriceMax !== '') {
    $sql .= " AND precio <= ?";
}

if ($valueSearchBar != '') {
    $sql .= " AND (titulo LIKE ? OR autor.nombre LIKE ? OR genero LIKE ? OR serie LIKE ? OR encuadernacion LIKE ? OR idioma LIKE ?)";
}

if ($selectedOrder == 'Precio ⭡') {
    $sql .= " ORDER BY precio ASC";
} else if ($selectedOrder == 'Precio ⭣') {
    $sql .= " ORDER BY precio DESC";
} else if ($selectedOrder == 'A-Z') {
    $sql .= " ORDER BY titulo ASC";
} else if ($selectedOrder == 'Z-A') {
    $sql .= " ORDER BY titulo DESC";
}

$sql .= " AND libro.activado = 1";


$params = [];
$types = "";

foreach ($selectedGenres as $genre) {
    $params[] = $genre;
    $types .= 's';
}

foreach ($selectedLanguage as $language) {
    $params[] = $language;
    $types .= 's';
}


if ($selectedPriceMin !== '') {
    $params[] = $selectedPriceMin;
    $types .= 'd';
}

if ($selectedPriceMax !== '') {
    $params[] = $selectedPriceMax;
    $types .= 'd';
}

if ($valueSearchBar !== '') {
    $searchTerm = "%" . $valueSearchBar . "%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= 'ssssss';
}

$stmt = $conn->prepare($sql);
if ($types != "") {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$libros_totales = $stmt->get_result(); //Libros totales
$numeroLibrosT = $libros_totales->num_rows;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['aumentar']) && $contador < (ceil($numeroLibrosT / $selectedDisplay))) {
    $contador++;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['disminuir']) && $contador > 1) {
    $contador--;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reset'])) {
    $contador = 1;
}

$sql .= " LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$params[] = $selectedDisplay;
$params[] = $selectedDisplay * ($contador - 1);
$types .= 'ii';
$stmt->bind_param($types, ...$params);
$stmt->execute();
$libros_xP = $stmt->get_result(); // Libros por pagina
$numeroLibrosxP = $libros_xP->num_rows;

$stmt->close();
$conn->close();
