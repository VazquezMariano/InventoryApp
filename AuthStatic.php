<?php
class AuthStatic{


    public static function init(){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    public static function login($user){
        AuthStatic::init();
        $_SESSION['USER_NOMBRE'] =  $user->nombreUsuario;
        $_SESSION['LOGUEADO'] = true;
    }

    public static function logout(){
        AuthStatic::init();
        session_destroy();
    }

    public static function verificar(){
        AuthStatic::init();
        if(!isset($_SESSION['USER_NOMBRE'])){
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }

}