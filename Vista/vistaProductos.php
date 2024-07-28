<?php


class vistaProductos{
    function showProductosAdmin($productos, $proveedores){
        require_once 'templates/start.phtml';
        require_once 'templates/mainInvitado.phtml';
        if(isset($_SESSION['LOGUEADO'])){ 
            require_once 'templates/mainAdmin.phtml';
        }
        require_once 'templates/end.phtml';
    }

    function showError($msj){
        require_once 'templates/errorGeneral.phtml';
        require_once 'templates/end.phtml';
    }
    
    function showProductoEditar($producto, $proveedor, $proveedores){
        require_once 'templates/start.phtml';
        require_once 'templates/edicion.phtml';
        require_once 'templates/end.phtml';
    }
    
    function showProv($proveedor){
        require_once 'templates/start.phtml';
        require_once 'templates/proveedor.phtml';
        require_once 'templates/end.phtml';
    }
}