<?php
require_once 'Modelo/Model.php';

class ModelUsuario extends Model{
    function __construct(){
        parent::__construct();
    }

    public function login($user){
        $query = $this->db->prepare("SELECT * FROM usuarios_admin WHERE nombreUsuario = ?");
        $query->execute([$user]);
        $datos = $query->fetch(PDO::FETCH_OBJ);
        return $datos;
    }
}