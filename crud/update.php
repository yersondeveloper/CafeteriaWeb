<?php
 class Actualizar extends Conexion {
   
     public function __construct(){
        parent::__construct();
    }
    //***********************************************************************************************************//
    public function modificar_producto($nombre, $referencia, $precio, $peso, $categoria, $stock, $estado, $id, $fecha_modifica){
   
	$sql = "UPDATE productos SET nombre = '$nombre', referencia = '$referencia', precio = $precio, peso = $peso, categoria = '$categoria', stock = $stock, estado = $estado, fecha_modificacion = '$fecha_modifica' WHERE id = $id";
	$res = $this->conexion_db->query($sql);
	if($res){
	  return true;
	}else{
	return false;
        }
    }
    //***********************************************************************************************************//
    public function modificar_usuario($nombre, $identificacion, $password, $perfil, $fecha_modifica, $estado, $id){
   
    $sql = "UPDATE usuarios SET nombre = '$nombre', identificacion = $identificacion, password = '$password', id_perfil = $perfil, fecha_modificacion = '$fecha_modifica', estado = $estado WHERE id = $id";
    $res = $this->conexion_db->query($sql);
    if($res){
        return true;
    }else{
        return false;
        }
    }

    //***********************************************************************************************************//
    public function actualiza_stock($resta_stock, $idproducto){
   
        $sql = "UPDATE productos SET stock = $resta_stock WHERE id =  $idproducto ";
        $res = $this->conexion_db->query($sql);
        if($res){
            return true;
        }else{
            return false;
            }
        }
}
?>