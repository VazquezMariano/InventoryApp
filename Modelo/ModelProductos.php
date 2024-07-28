<?php
require_once 'Modelo/Model.php';
class ModelProductos extends Model{
    function __construct(){
        parent::__construct();
    }

    public function showProductos(){
        $query = $this->db->prepare("SELECT * FROM productos");
        $query->execute();
        $datos = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $datos;
    }

    public function agregarProducto($proveedor, $nombre, $precio, $desc){
        $query = $this->db->prepare("INSERT INTO productos (id_prov, nombre, precio, descripcion) VALUES (?, ?, ?, ?)");
        $query->execute([$proveedor, $nombre, $precio, $desc]);
        return $this->db->lastInsertId();
    }

    public function showProducto($id){
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
        $prod = $query->fetch(PDO::FETCH_OBJ);
        return $prod;
    }

    public function actualizarProducto($id, $nombre, $precio, $desc, $prov){
        $query = $this->db->prepare("UPDATE productos SET id_prov = ?, nombre = ?, precio = ?, descripcion = ? WHERE id_producto = ?");
        return $query->execute([$prov, $nombre, $precio, $desc, $id]);
    }

    public function eliminarProducto($id){
        $query = $this->db->prepare("DELETE FROM productos WHERE id_producto = ?");
        return $query->execute([$id]);
    }

    public function modificarVarios($elementos, $modalidad, $porcentaje){
        $exito = true;
        for($i = 0; $i < count($elementos); $i++){
            $query = $this->db->prepare("SELECT precio FROM productos WHERE id_producto = ?");
            $query->execute([$elementos[$i]]);
            $Objeto = $query->Fetch(PDO::FETCH_OBJ);

            if($Objeto){
                $precioActual = $Objeto->precio;

                if($modalidad == "aum"){
                    $precioNuevo = $precioActual + ($precioActual * $porcentaje / 100);
                } elseif($modalidad == "dis") {
                    $precioNuevo = $precioActual - ($precioActual * $porcentaje / 100);
                }

                if(!($this->modificar($precioNuevo, $elementos[$i]))){
                    $exito = false;
                }
                

            } else {
                $exito = false;
            }


        }
        return $exito;
    }

    public function modificar($nuevoPrecio, $id){
        $query = $this->db->prepare("UPDATE productos SET precio = ? WHERE id_producto = ?");
        return $query->execute([$nuevoPrecio, $id]);

    }

    public function buscar($arg){
        $query = $this->db->prepare("SELECT * FROM productos WHERE (nombre LIKE ? OR descripcion LIKE ? OR precio LIKE ?) OR id_prov IN (
            SELECT id_provn
            FROM proveedores v
            WHERE v.nombre LIKE ?
            )");
            $query->execute(["%$arg%", "%$arg%", "%$arg%", "%$arg%"]);
            $datos = $query->fetchAll(PDO::FETCH_OBJ);
        
            return $datos;
    }
}