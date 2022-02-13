<?php
require '../conexion.php';
 class Consulta extends Conexion {
     public function __construct(){
        parent::__construct();
    }
    //*****************************************************************//
    public function read_select($estado){ 
         
        if(isset($estado['estado'])==1){
            echo 'selected="selected"';
        }         
    }
    //*****************************************************************//
    public function read_productos($nombre, $referencia){  
        $perfil = $_SESSION['perfil'];
        if ($perfil == 'Vendedor'){
            $sql = "SELECT id,nombre,referencia,precio,peso,categoria,stock,estado FROM productos WHERE estado = 1 AND (nombre LIKE '%$nombre%' OR referencia LIKE '%$referencia%') ";
        }else{
            $sql = "SELECT id,nombre,referencia,precio,peso,categoria,stock,estado FROM productos WHERE nombre LIKE '%$nombre%' OR referencia LIKE '%$referencia%' ";
        } 
        $busqueda= $this->conexion_db->query($sql);
        $resultado=$busqueda->fetch_all(MYSQLI_ASSOC);
        
        return $resultado;
    }
    //*****************************************************************//
    public function read_producto($referencia, $id){                
        $busqueda= $this->conexion_db->query("SELECT id,nombre,referencia,precio,peso,categoria,stock,estado FROM productos WHERE referencia = '$referencia' or id = $id ");
        $resultado=$busqueda->fetch_all(MYSQLI_ASSOC);
        
        return $resultado;
    }
    //**************************************************************************************************//
    public function cargar_perfil($sql){                
        $busqueda= $this->conexion_db->query($sql);
        $resultado=$busqueda->fetch_all(MYSQLI_ASSOC);
        
        return $resultado;
    }
    //*****************************************************************//
    public function read_usuarios($nombre, $identificacion){                
        $busqueda= $this->conexion_db->query("SELECT u.id, u.identificacion, u.nombre, p.nombre as perfil, u.estado FROM usuarios u INNER JOIN perfiles p ON p.id = u.id_perfil WHERE u.nombre LIKE '%$nombre%' OR u.identificacion LIKE '%$identificacion%' ");
        $resultado=$busqueda->fetch_all(MYSQLI_ASSOC);
        
        return $resultado;
    }
    //*****************************************************************//
    public function read_usuario($identificacion, $id){                
        $busqueda= $this->conexion_db->query("SELECT u.id, u.identificacion, u.nombre, p.nombre as perfil, u.password, u.estado FROM usuarios u INNER JOIN perfiles p ON p.id = u.id_perfil WHERE u.identificacion = '$identificacion' or u.id = '$id' ");
        $resultado=$busqueda->fetch_all(MYSQLI_ASSOC);
        
        return $resultado;
    }
    //*****************************************************************//
    public function read_ventas($nombre, $referencia){
        $idUsuario = $_SESSION['idUsuario'];            
        $busqueda= $this->conexion_db->query("SELECT v.numeroFactura, p.id, p.nombre, p.referencia, v.cantidad, v.valorVenta, v.fecha_venta FROM ventas v INNER JOIN productos p ON p.id = v.id_producto INNER JOIN usuarios u ON u.id = v.id_usuario WHERE u.id = $idUsuario AND p.nombre LIKE '%$nombre%' OR p.referencia LIKE '%$referencia%' ");
        $resultado=$busqueda->fetch_all(MYSQLI_ASSOC);
        
        return $resultado;
    }
    //**************************************************************************************************//
    public function cargar_Numerofactura($sql){                
        $busqueda= $this->conexion_db->query($sql);
        $resultado=$busqueda->fetch_all(MYSQLI_ASSOC);
        
        return $resultado;
    }
    //**************************************************************************************************//
    public function read_stock($sql){                
        $busqueda= $this->conexion_db->query($sql);
        $resultado=$busqueda->fetch_all(MYSQLI_ASSOC);
        
        return $resultado;
    }
}
?>