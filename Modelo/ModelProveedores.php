<?php
require_once 'Modelo/Model.php';

class ModelProveedores extends Model{
    function __construct(){
        parent::__construct();
    }

    public function showProveedores(){
        $query = $this->db->prepare('SELECT * FROM proveedores');
        $query->execute();
        $datos = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $datos;
    }

    public function showProveedor($id){
        $query = $this->db->prepare('SELECT * FROM proveedores WHERE id_provn = ?');
        $query->execute([$id]);
        $prov = $query->fetch(PDO::FETCH_OBJ);
        return $prov;
    }

    public function agregarProv($nombre, $num, $mail, $desc){
        $query = $this->db->prepare("INSERT INTO proveedores (nombre, num, mail, descripcion) VALUES (?, ?, ?, ?)");
        $query->execute([$nombre, $num, $mail, $desc]);
        return $this->db->lastInsertId();
    }

    public function actualizarProv($nombre, $num, $mail, $desc, $id){
        $query = $this->db->prepare("UPDATE proveedores SET nombre = ?, num = ?, mail = ?, descripcion = ? WHERE id_provn = ?");
        return $query->execute([$nombre, $num, $mail, $desc, $id]);
    }

    public function eliminarProv($id){
        $query = $this->db->prepare("DELETE FROM proveedores WHERE id_provn = ?");
        return $query->execute([$id]);
    }

}