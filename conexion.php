<?php

require_once('config.php');

class Conexion{
    protected $conexion_db;
    //declaro el constructor
    public function __construct()
    {
        //Realizo conexion a la base de datos
        $this->conexion_db = new mysqli(DB_PASS,DB_USER,DB_PASS,DB_NAME);

        if($this->conexion_db->connect_errno){
            echo "Fallo la conexión a la base de datos";
        }
        $this->conexion_db->set_charset('DB_CHARSET');
    }
    //funcion para limpiar los caracteres y evitar sql injection
    public function sanitize($var){
        $return = mysqli_real_escape_string($this->conexion_db, $var);
        return $return;
    }
}

?>