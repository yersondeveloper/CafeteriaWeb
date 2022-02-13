<?php

require 'conexion.php';

if (isset($_POST['btnIngresar'])){
     if((!isset($_POST['txtUsuario'])) || (!isset($_POST['txtPassword']))){
        $error = "<center><font color='red'><b>Debe Completar el formulario.</b></font></center><br>";
        echo $error;
    }
    $user = htmlentities($_POST['txtUsuario']);
    $pass = htmlentities($_POST['txtPassword']);
    if(($user == '') || ($pass == '')){
        $error = "<center><font color='red'><b>Por favor ingrese el usuario y la contraseña.</b></font></center><br>";
        echo $error;
    }
    
}
class DevuelveU extends Conexion{
    public function __construct(){
        parent::__construct();
    }
    //consulto el usario en la bd
    public function GetUsuarios(){
        $usuario = $_POST['txtUsuario'];
        $password = $_POST['txtPassword'];
        $resultado= $this->conexion_db->query("SELECT u.id, u.identificacion, u.nombre, p.nombre as perfil, u.estado FROM usuarios u INNER JOIN perfiles p ON p.id = u.id_perfil WHERE u.identificacion = '$usuario' AND u.password='$password' ");
        $usuarios=$resultado->fetch_all(MYSQLI_ASSOC);
        
        return $usuarios;
    }
}

?>