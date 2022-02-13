<?php
 class Crea extends Conexion {
   
    public function __construct(){
        parent::__construct();
    }
    //**********************************************************************************//
    public function crear_producto($nombre, $referencia, $precio, $peso, $categoria, $stock, $estado, $usuariocrea, $fecha){
   
	$sql = "INSERT INTO productos (nombre, referencia, precio, peso, categoria, stock, estado id_usuario_crea, fecha_creacion) VALUES ('$nombre', '$referencia', $precio, $peso, '$categoria', $stock, $estado, $usuariocrea, '$fecha')";
	$res = $this->conexion_db->query($sql);
	if($res){
	  return true;
	}else{
	return false;
        }   
    }
    //**********************************************************************************//
    public function crear_usuario($nombre, $identificacion, $password, $perfil, $fecha, $estado){
   
    $sql = "INSERT INTO usuarios (nombre, identificacion, password, id_perfil, fecha_creacion, fecha_modificacion, estado) VALUES ('$nombre', $identificacion, '$password', $perfil, '$fecha', NULL, $estado)";
    $res = $this->conexion_db->query($sql);
    if($res){
        return true;
    }else{
        return false;
        }   
    }
    //**********************************************************************************//
    public function crear_venta($idproducto, $idusuario, $numerofactura, $cantidad, $valorventa, $fecha){

    $sql = "INSERT INTO ventas (id_producto, id_usuario, numeroFactura, cantidad, valorVenta, fecha_venta) VALUES ($idproducto, $idusuario, $numerofactura, $cantidad, $valorventa, '$fecha')";
    $res = $this->conexion_db->query($sql);
    if($res){
        return true;
    }else{
        return false;
        }   
    }
}
?>
