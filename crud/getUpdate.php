<script src="../js/jQuery1.9.1.min.js"></script>
<?php
require_once "../conexion.php";
require_once 'update.php';
?>
<?php
//actualizar el producto
if(isset($_POST['btnModificarProducto'])){
    $productos = new Conexion();
    $producto = new Actualizar();
    if(isset($_POST) && !empty($_POST)){
        $nombre = $productos->sanitize($_POST['txtnombre']);
        $referencia = $productos->sanitize($_POST['txtreferencia']);
        $precio = $productos->sanitize($_POST['txtprecio']);
        $peso = $productos->sanitize($_POST['txtpeso']);
        $categoria = $productos->sanitize($_POST['txtcategoria']);
        $stock = $productos->sanitize($_POST['txtstock']);
        $estado = $productos->sanitize($_POST['cmbEstado']);
        $id = $productos->sanitize($_POST['id_producto']);
        $fecha_modifica = date('Y-m-d');

        $res = $producto->modificar_producto($nombre, $referencia, $precio, $peso, $categoria, $stock, $estado, $id, $fecha_modifica);
        if($res){     
	       echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong> Ejecutando......  Datos Actualizados con éxito </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';           
        }else{   
	       echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>No se pudo actualizar los datos</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';   
        }
        echo "<script>
        $(document).ready(function() {
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
        
        setTimeout(function() {
           window.location.href = 'home.php?mod=productos';
        }, 2000); 
        });
        </script>";
    }
}
//actualizar el usuario
if(isset($_POST['btnModificarUsuario'])){
    $usuarios = new Conexion();
    $usuario = new Actualizar();
    if(isset($_POST) && !empty($_POST)){
        $nombre = $usuarios->sanitize($_POST['txtnombre']);
        $identificacion = $usuarios->sanitize($_POST['txtidentificacion']);
        $perfil = $usuarios->sanitize($_POST['cmbIdPerfil']);
        $password = $usuarios->sanitize($_POST['txtpassword']);
        $estado = $usuarios->sanitize($_POST['cmbEstado']);
        $id = $usuarios->sanitize($_POST['id_usuario']);
        $fecha_modifica = date('Y-m-d');

        $res = $usuario->modificar_usuario($nombre, $identificacion, $password, $perfil, $fecha_modifica, $estado, $id);
        if($res){     
	       echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong> Ejecutando......  Datos Actualizados con éxito </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';           
        }else{   
	       echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>No se pudo actualizar los datos</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';   
        }
        echo "<script>
        $(document).ready(function() {
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
        
        setTimeout(function() {
           window.location.href = 'home.php?mod=usuarios';
        }, 2000); 
        });
        </script>";
    }
}
?>