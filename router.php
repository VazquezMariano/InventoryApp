<?php
require_once 'Controladores/GeneralController.php';
require_once 'Controladores/AuthController.php';
require_once 'Vista/vistaAuth.php';

define('BASE_URL', '//'. $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'].dirname($_SERVER['PHP_SELF']).'/' );


$action = "homeAdmin";
if(!empty($_GET['action'])){
    $action = $_GET['action'];
}
$params = explode('/', $action);

switch($params[0]){
    case 'login':
        $login = new AuthController();
        $login->showIngreso();
        break;
    case 'Autenticar':
        $autenticar = new AuthController();
        $autenticar->autenticar();
        break;
    case 'homeAdmin':
        $controller = new GeneralController();
        $controller->homeAdmin();
        break;
    case 'agregar':
        $controller = new GeneralController();
        $controller->agregar();
        break;
    case "logOut":
        $controller = new AuthController();
        $controller->logout();
        break;
    case "editar":
        $controller = new GeneralController();
        $controller->editar($params[1]);
        break;
    case "procEdicion":
        $controller = new GeneralController();
        $controller->procEdicion();
        break;
    case "agregarProv":
        $controller = new GeneralController();
        $controller->agregarProv();
        break;
    case "eliminarProd":
        $controller = new GeneralController();
        $controller->eliminarProd($params[1]);
        break;
    case "proveedor":
        $controller = new GeneralController();
        $controller->showProv($params[1]);
        break;
    case "actualizarProv":
        $controller = new GeneralController();
        $controller->modificarProv();
        break;
    case "porcentaje":
        $controller = new GeneralController();
        $controller->porcentaje();
        break;
    case "buscar":
        $controller = new GeneralController();
        $controller->busqueda();
        break;
    case "eliminarProv":
        $controller = new GeneralController();
        $controller->eliminarProv($params[1]);
        break;
        
}