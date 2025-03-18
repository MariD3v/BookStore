<?php
include("../server/profile.php");

if (!isset($_SESSION['administrador']) == 1) {
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
                    <a href="#">
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
                            <li><a href="#">Ver productos</a></li>
                            <li><a href="#">Añadir producto</a></li>
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
                            <li><a href="#">Ver usuarios</a></li>
                            <li><a href="#">Añadir usuario</a></li>
                        </div>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="container">
            <div class="sub-container">
                <h3>Panel de administración</h3>
            </div>
        </div>
    </main>
    <script src="../scripts/adminpanel.js"></script>
</body>

</html>