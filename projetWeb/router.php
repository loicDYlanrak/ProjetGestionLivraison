<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        require_once 'controllers/HomeController.php';
        break;
    default:
        echo "404 - Page non trouvée";
        break;
}