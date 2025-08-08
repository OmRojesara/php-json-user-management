<?php


require_once 'classes/Helper.php';
require_once 'classes/User.php';
require_once 'classes/UserRepository.php';
require_once 'classes/UserController.php';
session_start();

$controller = new UserController();

$action = $_GET['action'] ?? 'list';

// Restrict actions unless user is logged in, except allowed public actions
if (!isset($_SESSION['user']) && !in_array($action, ['login', 'do_login', 'register', 'do_register'])) {
    $controller->showLoginForm();
    exit;
}

switch ($action) {
    case 'login':
        $controller->doLogin();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'register':
        $controller->showRegisterForm();
        break;
    case 'do_register':
        $controller->doRegister();
        break;
    case 'add':
        $controller->addUser();
        break;
    case 'store':
        $controller->storeUser();
        break;
    case 'edit':
        $controller->editUser();
        break;
    case 'update':
        $controller->updateUser();
        break;
    case 'delete':
        $controller->deleteUser();
        break;
    case 'view':
        $controller->viewUser();
        break;
    default:
        $controller->listUsers();
        break;
}
?>
