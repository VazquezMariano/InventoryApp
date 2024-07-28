<?php
require_once 'Modelo/ModelUsuario.php';
require_once 'Vista/vistaAuth.php';
require_once 'AuthStatic.php';

class AuthController{
    private $model;
    private $view;

    function __construct(){
        $this->model = new ModelUsuario();
        $this->view = new vistaAuth();
    }

    function showIngreso(){
        $this->view->showLogin();
    }

    function autenticar(){
        if(isset($_POST["user"]) && isset($_POST["password"])){
            if(!empty($_POST["user"]) && !empty($_POST["password"])){
                $user = $_POST["user"];
                $pass = $_POST["password"];

                $user = $this->model->login($user);
                if($user && password_verify($pass, $user->passwordUsuario)){
                    AuthStatic::login($user);
                    header('Location: ' . BASE_URL .'homeAdmin');
                } else {
                    $this->view->showError("DATOS ERRONEOS");
                }
            } else {
                $this->view->showError("RELLENE TODOS LOS CAMPOS");
            }
        }
    }

    function logout() {
        AuthStatic::logout();
        header('Location: ' . BASE_URL . "login");    
    }

}