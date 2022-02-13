<?php

require_once "../conexion.php";
require_once 'create.php';
require_once 'read.php';
require_once 'update.php';

?>
<?php
if (isset($_POST['btnCrearProducto'])) {
    $productos = new Conexion();
    $producto = new Crea();
    if (isset($_POST) && !empty($_POST)) {
        $result = new Consulta();
        $array_producto = $result->read_producto($_POST['txtreferencia'], '');
        $cantidad = count($array_producto);
        if ($cantidad == 1) {
            echo '<script type="text/javascript">Swal.fire({
			    title: "Ya existe un producto creado con esta referencia en el Sistema",
			    text: "Por favor verifique la información ingresada.",
			    type: "error",
			    confirmButtonColor: "#3085d6",
			    confirmButtonText: "Cerrar",
                allowOutsideClick: false,
		        }).then((result) => {
			    if (result.value) {
				window.location="home.php?mod=productos";
			    }
		        });</script>';
        } else {
            $nombre = $productos->sanitize($_POST['txtnombre']);
            $referencia = $productos->sanitize($_POST['txtreferencia']);
            $precio = $productos->sanitize($_POST['txtprecio']);
            $peso = $productos->sanitize($_POST['txtpeso']);
            $categoria = $productos->sanitize($_POST['txtcategoria']);
            $stock = $productos->sanitize($_POST['txtstock']);
            $estado = $productos->sanitize($_POST['cmbEstado']);
            $usuariocrea = $productos->sanitize($_POST['idUsuario']);
            $fecha = date('Y-m-d');

            $res = $producto->crear_producto($nombre, $referencia, $precio, $peso, $categoria, $stock, $estado, $usuariocrea, $fecha);
            if ($res) {
                echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>Datos insertados con éxito</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>No se pudieron insertar los datos</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
        }
    }
}
// crear usuario
if (isset($_POST['btnCrearUsuario'])) {
    $usuarios = new Conexion();
    $usuario = new Crea();
    if (isset($_POST) && !empty($_POST)) {
        $result = new Consulta();
        $array_usuario = $result->read_usuario($_POST['txtidentificacion'], '');
        $cantidad = count($array_usuario);
        if ($cantidad == 1) {
            echo '<script type="text/javascript">Swal.fire({
			    title: "Ya existe un usuario con esta identificación en el Sistema",
			    text: "Por favor verifique la información ingresada.",
			    type: "error",
			    confirmButtonColor: "#3085d6",
			    confirmButtonText: "Cerrar",
                allowOutsideClick: false,
		        }).then((result) => {
			    if (result.value) {
				window.location="home.php?mod=usuarios";
			    }
		        });</script>';
        } else {
            $nombre = $usuarios->sanitize($_POST['txtnombre']);
            $identificacion = $usuarios->sanitize($_POST['txtidentificacion']);
            $perfil = $usuarios->sanitize($_POST['cmbIdPerfil']);
            $password = $usuarios->sanitize($_POST['txtpassword']);
            $estado = $usuarios->sanitize($_POST['cmbEstado']);
            $fecha = date('Y-m-d');

            $res = $usuario->crear_usuario($nombre, $identificacion, $password, $perfil, $fecha, $estado);
            if ($res) {
                echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>Datos insertados con éxito</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>No se pudieron insertar los datos</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
        }
    }
}
//guardar venta
if (isset($_POST['btnGuardarVenta'])) {
    $ventas = new Conexion();
    $venta = new Crea();
    if (isset($_POST) && !empty($_POST)) {
        $idproducto = $ventas->sanitize($_POST['idProducto']);
        $idusuario = $ventas->sanitize($_POST['idUsuario']);
        $numerofactura = $ventas->sanitize($_POST['txtnumerofactura']);
        $cantidad = $ventas->sanitize($_POST['txtcantidad']);
        $cantidad_restar = $cantidad;
        $valorventa = $ventas->sanitize($_POST['total']);
        $fecha = date('Y-m-d');

        $res = $venta->crear_venta($idproducto, $idusuario, $numerofactura, $cantidad, $valorventa, $fecha);
        if ($res) {
            //Actualizo el stock del producto
            $result = new Consulta();
            $sql = "SELECT stock FROM productos WHERE id = '$idproducto' ";
            $array_stock = $result->read_stock($sql);
            $cantidad = count($array_stock);
            foreach($array_stock as $item){
                $stock = $item['stock'];
            }
            
            $resta_stock = $stock - $cantidad_restar;
            $actualiza = new Actualizar();
            $res = $actualiza->actualiza_stock($resta_stock, $idproducto);

            echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>Datos insertados con éxito</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>No se pudieron insertar los datos</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
        }
    }
}
?>
<script src="../vendor/js/jQuery1.9.1.min.js"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").alert('close');
        }, 3000);
    });
</script>