<?php
require_once 'configSQL.php';
abstract class Model{
    protected $db;

    function __construct(){
        $this->db = new PDO("mysql:host=". DB_HOST .";dbname=". DB_NAME .";charset=utf8", DB_USER, "");
    }
}