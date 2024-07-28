<?php

class vistaAuth{
    function showLogin(){
        require_once 'templates/start.phtml';
        require_once 'templates/login.phtml';
        require_once 'templates/end.phtml';
    }

    function showError($msj){
        require_once 'templates/start.phtml';
        require_once 'templates/login.phtml';
        require_once 'templates/error.phtml';
        require_once 'templates/end.phtml';
    }
}