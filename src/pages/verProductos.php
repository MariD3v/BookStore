<?php
include("../server/profile.php");
include("../server/adminpanel.php");


if (!checkUserPerms($_SESSION['user_id'])) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración | Bookstore</title>
    <link rel="stylesheet" href="../styles/style.css" type="text/css" />
    <link rel="stylesheet" href="../styles/adminpanel.css" type="text/css" />
    <link rel="shortcut icon" href="../assets/images/admin_panel_icon.webp" type="image/x-icon">
    <link rel="stylesheet" href="../styles/adminTable.css" type="text/css" />
</head>

<body>
    <main>
        <nav id="sidebar">
            <ul>
                <li>
                    <span class="logo">Administración</span>
                    <button id="toggle-btn" onclick="toggleSidebar()">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                            <path d="M440-240 200-480l240-240 56 56-183 184 183 184-56 56Zm264 0L464-480l240-240 56 56-183 184 183 184-56 56Z" />
                        </svg>
                    </button>
                </li>
                <li>
                    <a href="./adminpanel.php">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                            <path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
                        </svg>
                        <span>Inicio</span>
                    </a>
                </li>
                <li>
                    <button class="dropdown-btn" onclick="toggleSubMenu(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                            <path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z" />
                        </svg>
                        <span>Productos</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                            <path d="M480-360 280-560h400L480-360Z" />
                        </svg>
                    </button>
                    <ul class="sub-menu">
                        <div>
                            <li><a href="./verProductos.php">Ver productos</a></li>
                        </div>
                    </ul>
                </li>
                <li>
                    <button class="dropdown-btn" onclick="toggleSubMenu(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                            <path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z" />
                        </svg>
                        <span>Usuarios</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                            <path d="M480-360 280-560h400L480-360Z" />
                        </svg>
                    </button>
                    <ul class="sub-menu">
                        <div>
                            <li><a href="./verUsuario.php">Ver usuarios</a></li>
                        </div>
                    </ul>
                </li>
            </ul>
        </nav>
        <header>
            <div class="topbar">
                <button class="dropdown-btn" onclick="topbarSubMenu(event, this)">
                    <div class="user-info">
                        <svg xmlns="http://www.w3.org/2000/svg" height="43px" viewBox="0 -960 960 960" width="43px" fill="#e3e3e3">
                            <path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                        </svg>
                        <div class="infor">
                            <span class="name"><?php echo (ucfirst($_SESSION['user_name'])) ?></span>
                            <span class="role">Administrador</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                            <path d="M480-360 280-560h400L480-360Z" />
                        </svg>
                    </div>
                </button>
                <div class="dropdown-menu" id="dropdownMenu">
                    <ul>
                        <li>
                            <a href="../pages/perfil.php">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                                    <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                                </svg>
                                <span>Perfil</span>
                            </a>
                        </li>
                        <li>
                            <a href="perfil.php?cerrarsesion=1">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                                </svg>
                                <span>Cerrar sesión</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="content">
            <div class="users">
                <div class="ver-users">
                    <div class="search-bar">
                        <h1>Lista de productos</h1>
                        <div class="search-options">
                            <button class="btn-product" onclick="abrirModalNuevoLibro()">➕</button>
                            <input type="text" id="searchInput" placeholder="Buscar libro.." onkeyup="searchProducts()" />
                        </div>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Titulo</th>
                                    <th>Generos</th>
                                    <th>Editorial</th>
                                    <th>Idioma</th>
                                    <th>Precio</th>
                                    <th>Serie</th>
                                    <th>Número</th>
                                    <th>Autores</th>
                                    <th>Activado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty(getProductsForTable())) {
                                    foreach (getProductsForTable() as $products) {
                                        echo "<tr>";
                                        echo "<td data-label='Código'>" . $products['codigo_libro'] . "</td>";
                                        echo "<td data-label='Titulo'>" . $products['titulo'] . "</td>";
                                        echo "<td data-label='Generos'>" . $products['genero'] . "</td>";
                                        echo "<td data-label='Editorial'>" . $products['editorial'] . "</td>";
                                        echo "<td data-label='Idioma'>" . $products['idioma'] . "</td>";
                                        echo "<td data-label='Precio'>" . $products['precio'] . "</td>";
                                        echo "<td data-label='Serie'>" . $products['serie'] . "</td>";
                                        echo "<td data-label='Número'>" . $products['numero'] . "</td>";
                                        echo "<td data-label='Autores'>";

                                        $authors = getAuthorsById($products['codigo_autor']);
                                        if (is_array($authors)) {
                                            foreach ($authors as $author) {
                                                echo $author['nombre'];
                                            }
                                        } else {
                                            echo "Sin autores";
                                        }
                                        echo "</td>";
                                        echo "<td data-label='Activado' style='text-align: center;'>";
                                        if ($products['activado'] == 1) {
                                            echo "<p>Sí</p>";
                                        } else {
                                            echo "<p>No</p>";
                                        }
                                        echo "</td>";
                                        echo "<td data-label='Acciones' class='actions'>";
                                        echo "<svg class='editar-modal-btn' data-codigo-libro='{$products['codigo_libro']}' xmlns='http://www.w3.org/2000/svg' 
                                                height='24px'viewBox='0 -960 960 960' width='24px' fill='#e3e3e3' style='cursor:pointer'>
                                                <path d='M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z'/>
                                            </svg>
                                            <svg class='delete-btn-product' data-codigo-libro='" . $products['codigo_libro'] . "xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#e3e3e3'>
                                                    <path d='m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z'/>
                                                </svg>";
                                        echo "</td>";
                                    }
                                } else {
                                    echo "<tr><td colspan='12'>No hay productos disponibles.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="editBookModal-container" class="editBookModal-modal">
        <div class="editBookModal-content">
            <span class="editBookModal-close">&times;</span>
            <h2 class="editBookModal-title">Editar Libro</h2>

            <form id="editBookForm">
                <input type="hidden" id="edit-codigo_libro" name="codigo_libro">

                <label for="edit-titulo">Título:</label>
                <input type="text" id="edit-titulo" name="titulo" required maxlength="40">

                <label for="edit-genero">Género:</label>
                <input type="text" id="edit-genero" name="genero" required maxlength="40">

                <label for="edit-editorial">Editorial:</label>
                <input type="text" id="edit-editorial" name="editorial" required maxlength="30">

                <label for="edit-n_pag">Nº de Páginas:</label>
                <input type="number" id="edit-n_pag" name="n_pag" required min="1">

                <label for="edit-idioma">Idioma:</label>
                <select id="edit-idioma" name="idioma" required>
                    <option value="Español">Español</option>
                    <option value="Inglés">Inglés</option>
                </select>

                <label for="edit-fecha_publ">Fecha de Publicación:</label>
                <input type="date" id="edit-fecha_publ" name="fecha_publ" required>

                <label for="edit-encuadernacion">Encuadernación:</label>
                <select id="edit-encuadernacion" name="encuadernacion" required>
                    <option value="Tapa blanda">Tapa blanda</option>
                    <option value="Tapa dura">Tapa dura</option>
                </select>

                <label for="edit-precio">Precio (€):</label>
                <input type="number" id="edit-precio" name="precio" required step="0.01" min="0">

                <label for="edit-descripcion_libro">Descripción:</label>
                <textarea id="edit-descripcion_libro" name="descripcion_libro" required></textarea>

                <label for="edit-serie">Serie:</label>
                <input type="text" id="edit-serie" name="serie" placeholder="Trono de Cristal" maxlength="40">

                <label for="edit-numero">Número:</label>
                <input type="number" id="edit-numero" name="numero" min="1">

                <label for="edit-codigo_autor">Código del Autor:</label>
                <select id="edit-codigo_autor" name="codigo_autor" required>
                    <option value="0">Seleccionar autor</option>
                    <?php
                    $authors = getAuthors();
                    if (is_array($authors)) {
                        foreach ($authors as $author) {
                            echo "<option value='" . $author['codigo_autor'] . "'>" . $author['nombre'] . "</option>";
                        }
                    } else {
                        echo "<option value='0'>Sin autores</option>";
                    }
                    ?>
                </select>

                <label for="edit-activado">Activado:</label>
                <select id="edit-activado" name="activado" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>

                <div class="editBookModal-actions">
                    <button type="button" onclick="guardarLibro()">Guardar Cambios</button>
                    <button type=" button" class="editBookModal-cancel">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para agregar productos nuevos -->
    <div id="updateBookModal-container" class="updateBookModal-modal">
        <div class="updateBookModal-content">
            <span class="updateBookModal-close">&times;</span>
            <h2 class="updateBookModal-title">Editar Libro</h2>

            <form id="updateBookForm">
                <label for="update-titulo">Título:</label>
                <input type="text" id="update-titulo" name="titulo" required maxlength="40">

                <label for="update-genero">Género:</label>
                <input type="text" id="update-genero" name="genero" required maxlength="40">

                <label for="update-editorial">Editorial:</label>
                <input type="text" id="update-editorial" name="editorial" required maxlength="30">

                <label for="update-n_pag">Nº de Páginas:</label>
                <input type="number" id="update-n_pag" name="n_pag" required min="1">

                <label for="update-idioma">Idioma:</label>
                <select id="update-idioma" name="idioma" required>
                    <option value="Español">Español</option>
                    <option value="Inglés">Inglés</option>
                </select>

                <label for="update-fecha_publ">Fecha de Publicación:</label>
                <input type="date" id="update-fecha_publ" name="fecha_publ" required>

                <label for="update-encuadernacion">Encuadernación:</label>
                <select id="update-encuadernacion" name="encuadernacion" required>
                    <option value="Tapa blanda">Tapa blanda</option>
                    <option value="Tapa dura">Tapa dura</option>
                </select>

                <label for="update-precio">Precio (€):</label>
                <input type="number" id="update-precio" name="precio" required step="0.01" min="0">

                <label for="update-descripcion_libro">Descripción:</label>
                <textarea id="update-descripcion_libro" name="descripcion_libro" required></textarea>

                <label for="update-serie">Serie:</label>
                <input type="text" id="update-serie" name="serie" placeholder="Trono de Cristal" maxlength="40">

                <label for="update-numero">Número:</label>
                <input type="number" id="update-numero" name="numero" min="1">

                <label for="update-codigo_autor">Código del Autor:</label>
                <select id="update-codigo_autor" name="codigo_autor" required>
                    <option value="0">Seleccionar autor</option>
                    <?php
                    $authors = getAuthors();
                    if (is_array($authors)) {
                        foreach ($authors as $author) {
                            echo "<option value='" . $author['codigo_autor'] . "'>" . $author['nombre'] . "</option>";
                        }
                    } else {
                        echo "<option value='0'>Sin autores</option>";
                    }
                    ?>
                </select>

                <label for="update-activado">Activado:</label>
                <select id="update-activado" name="activado" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>

                <div class="updateBookModal-actions">
                    <button type="button" onclick="insertarLibro()">Guardar Cambios</button>
                    <button type="button" class="updateBookModal-cancel">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer-admin">
        <div class="footer-content">
            <p>&copy; <?php echo (date("Y")) ?> Bookstore. Todos los derechos reservados.</p>
            <button id="darkModeToggle" onclick="toggleDarkMode()">
                <svg id="bulbIcon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#e3e3e3">
                    <path d="M9 21h6v-1H9v1zm-2-2h10v-1H7v1zm5-18C8.14 1 5 4.14 5 8c0 2.38 1.19 4.47 3 5.74V16c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.86-3.14-7-7-7zm3.65 11.35-.65.46V15h-4v-2.19l-.65-.46C8.21 11.91 7 10.05 7 8c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.05-1.21 3.91-3.35 5.35z" />
                </svg>
            </button>
        </div>
    </footer>
    <script src="../scripts/adminpanel.js"></script>
    <script src="../scripts/darkMode.js"></script>
</body>

</html>