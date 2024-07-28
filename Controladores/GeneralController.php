<?php
require_once 'Modelo/ModelProductos.php';
require_once 'Modelo/ModelProveedores.php';
require_once 'Vista/vistaProductos.php';
require_once 'AuthStatic.php';

class GeneralController{
    private $modelProductos;
    private $modelProveedores;
    private $view;

    function __construct(){
        $this->modelProductos = new ModelProductos();
        $this->modelProveedores = new ModelProveedores();
        $this->view = new vistaProductos();
    }

    function homeAdmin(){
        AuthStatic::init();
        $productos = $this->modelProductos->showProductos();
        $proveedores = $this->modelProveedores->showProveedores();
        $this->view->showProductosAdmin($productos, $proveedores);
    }

    function agregar(){
        AuthStatic::verificar();
        $boolean = true;
        foreach($_POST as $campo => $valor){
            if(isset($valor)){
                if(empty($valor)){
                    $this->view->showError("CAMPOS VACÍOS");
                    $boolean = false;
                }
            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
                $boolean = false;
            }
        }

        if($boolean){
            if(isset($_POST['proveedor']) && isset($_POST['pNombre']) && isset($_POST['pPrecio']) && isset($_POST['pDesc'])){
                $proveedor = $_POST['proveedor'];
                $nombre = $_POST['pNombre'];
                $precio = $_POST['pPrecio'];
                $desc = $_POST['pDesc'];
                $producto = $this->modelProductos->agregarProducto($proveedor,$nombre,$precio,$desc);
                if($producto){
                    header('Location: ' . BASE_URL.'homeAdmin');
                } else {
                    $this->view->showError("NO SE AGREGÓ CORRECTAMENTE");
                }
            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
            }
        }
        
    }

    function editar($id){
        AuthStatic::verificar();
        $producto = $this->modelProductos->showProducto($id);
        $proveedor = $this->modelProveedores->showProveedor($producto->id_prov);
        $proveedores = $this->modelProveedores->showProveedores();

        $this->view->showProductoEditar($producto, $proveedor, $proveedores);

    }

    function procEdicion(){
        AuthStatic::verificar();
        $boolean = true;
        foreach($_POST as $campo => $valor){
            if(isset($valor)){
                if(empty($valor)){
                    $this->view->showError("CAMPOS VACÍOS");
                    $boolean = false;
                }
            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
                $boolean = false;
            }
        }
        if($boolean){
            if(isset($_POST['idProducto']) && isset($_POST['nombreProducto']) && isset($_POST['precioProducto']) && isset($_POST['descripcionProducto']) && isset($_POST['proveedorProducto'])){
                $id = $_POST['idProducto'];
                $nombre = $_POST['nombreProducto'];
                $precio = $_POST['precioProducto'];
                $desc = $_POST['descripcionProducto'];
                $prov = $_POST['proveedorProducto'];
                
                $actualizacion = $this->modelProductos->actualizarProducto($id, $nombre, $precio, $desc, $prov);
                if($actualizacion){
                    header('Location: ' . BASE_URL.'homeAdmin');
                } else {
                    $this->view->showError("NO SE AGREGÓ CORRECTAMENTE");
                }
                




            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
            }
        }
    }

    function agregarProv(){
        AuthStatic::verificar();
        $boolean = true;
        foreach($_POST as $campo => $valor){
            if(isset($valor)){
                if(empty($valor)){
                    $this->view->showError("CAMPOS VACÍOS");
                    $boolean = false;
                }
            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
                $boolean = false;
            }
        }

        if($boolean){
            if(isset($_POST['provNombre']) && isset($_POST['eMail']) && isset($_POST['provDesc']) && isset($_POST['tel'])){
                $nombre = $_POST['provNombre'];
                $email = $_POST['eMail'];
                $num = $_POST['tel'];
                $desc = $_POST['provDesc'];

                $proveedorNuevo = $this->modelProveedores->agregarProv($nombre, $num, $email, $desc);

                if($proveedorNuevo){
                    header('Location: ' . BASE_URL.'homeAdmin');
                } else {
                    $this->view->showError("NO SE AGREGÓ CORRECTAMENTE");
                }
            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
            }
        }
    }
    
    function eliminarProv($id){
        AuthStatic::verificar();
        $eliminacion = $this -> modelProveedores ->eliminarProv($id);
        if($eliminacion){
            header('Location: ' . BASE_URL.'/homeAdmin');
        } else {
            $this->view->showError("NO SE ELIMINÓ CORRECTAMENTE");
        }
    }

    function eliminarProd($id){
        AuthStatic::verificar();
        $eliminacion = $this -> modelProductos ->eliminarProducto($id);
        if($eliminacion){
            header('Location: ' . BASE_URL.'/homeAdmin');
        } else {
            $this->view->showError("NO SE ELIMINÓ CORRECTAMENTE");
        }
    }

    function showProv($id){
        AuthStatic::init();
        //traer proveedor individual con modelo
        //pasarle proveedor individual a la view
        $prov = $this->modelProveedores->showProveedor($id);
        $this->view->showProv($prov);
    }

    function modificarProv(){
        AuthStatic::verificar();
        $boolean = true;
        foreach($_POST as $campo => $valor){
            if(isset($valor)){
                if(empty($valor)){
                    $this->view->showError("CAMPOS VACÍOS");
                    $boolean = false;
                }
            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
                $boolean = false;
            }
        }
        if($boolean){
            if(isset($_POST['provNombre']) && isset($_POST['eMail']) && isset($_POST['provDesc']) && isset($_POST['tel']) && isset($_POST['idProvn'])){
                $nombre = $_POST['provNombre'];
                $email = $_POST['eMail'];
                $num = $_POST['tel'];
                $desc = $_POST['provDesc'];
                $id = $_POST['idProvn'];

                $modificarProv = $this->modelProveedores->actualizarProv($nombre, $num, $email, $desc, $id);

                if($modificarProv){
                    header('Location: ' . BASE_URL.'proveedor/' . $id);
                } else {
                    $this->view->showError("NO SE ACTUALIZÓ CORRECTAMENTE");
                }
            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
            }
        }
    }

    function porcentaje(){
        AuthStatic::verificar();
        $boolean = true;
        foreach($_POST as $campo => $valor){
            if(isset($valor)){
                if(empty($valor)){
                    $this->view->showError("CAMPOS VACÍOS");
                    $boolean = false;
                }
            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
                $boolean = false;
            }
        }
        if($boolean){
            if(isset($_POST['elementos']) && is_array($_POST['elementos']) && isset($_POST['modalidad']) && isset($_POST['porcentaje'])){
                $elementos = $_POST['elementos'];
                $modalidad = $_POST['modalidad'];
                $porcentaje = $_POST['porcentaje'];

                $modificaciones = $this->modelProductos->modificarVarios($elementos, $modalidad, $porcentaje);
                if($modificaciones){
                    header('Location: ' . BASE_URL.'/homeAdmin');
                } else {
                    $this->view->showError("NO SE ACTUALIZÓ CORRECTAMENTE");
                }

            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
            }
        }
    }

    function busqueda(){
        AuthStatic::init();
        $boolean = true;
        foreach($_POST as $campo => $valor){
            if(isset($valor)){
                if(empty($valor)){
                    $this->view->showError("CAMPOS VACÍOS");
                    $boolean = false;
                }
            } else {
                $this->view->showError("ERROR, VUELVA A INTENTAR");
                $boolean = false;
            }
        }
        if($boolean){
            if(isset($_POST["busqueda"])){
                $busqueda = $_POST["busqueda"];
                $elementos = $this->modelProductos->buscar($busqueda);
                $proveedores = $this->modelProveedores->showProveedores();
                if($elementos && $proveedores){
                    $this->view->showProductosAdmin($elementos, $proveedores);
                } else {
                    $this->view->showError("LA BÚSQUEDA FALLÓ, INTENTE OTRA VEZ");
                }
            }
        } else {
            $this->view->showError("ERROR, VUELVA A INTENTAR");
        }
    }


}