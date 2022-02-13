<?php
error_reporting(E_ALL ^ E_NOTICE);
if (isset($_SESSION['usuario'])) {

?>
    <?php
    require_once('../crud/read.php');
    require_once('../crud/getcreate.php');

    $verificar = new Conexion();
    $resultado = new Consulta();
    $nombre = $_POST['txtBuscarProducto'];
    $array_ventas = $resultado->read_ventas($nombre,$nombre);

    //Valido stock para generar la alerta
    if(isset($_POST['btnProductoSeleccionado'])){
        $result = new Consulta();
        $idproducto = $_POST['id_producto'];
        $sql = "SELECT stock FROM productos WHERE id = '$idproducto' ";
        $array_stock = $result->read_stock($sql);
        $cantidad = count($array_stock);
        foreach($array_stock as $item){
            $stock = $item['stock'];
        }
    }
    ?>
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 pb-3">
        <form action="home.php?mod=ventas" method="post" class="mb-3">
            <div class="container text-center pb-3 mt-3">
                <h3><i class="fas fa-money-bill-alt"></i>&nbsp;VENTAS</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="form-row align-items-center d-flex justify-content-center">
                        <div class="col-sm-2">
                            <div class="input-group d-flex justify-content-md-end justify-content-sm-start">
                                <label class="my-0">Buscar Por:&nbsp;</label>
                            </div>
                        </div>
                        <div class="col-sm-4 my-0">
                            <div class="input-group">
                                <input type="text" class="form-control" id="txtBuscar" name="txtBuscarProducto" placeholder="Nombre o Referencia de Producto">&nbsp;
                            </div>
                        </div>
                        <div class="col-sm-2 my-0">
                            <div class="input-group">
                                <button type="submit" name="btnBuscar" class="btn btn-primary btn-block boton">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['btnBuscar']))  {
            $producto = $_POST['txtBuscarProducto'];
            $array_producto = $resultado->read_productos($producto, $producto);
        ?>
            <div class="form-row align-items-center d-flex justify-content-center">
                <div class="table-responsive-md col-md-6">
                    <table class="table table-sm table-bordered table-striped text-center" id="ventas" data-page-length='5'>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Referencia</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($array_producto as $item2) {
                                $cantidad = count($array_producto);
                            ?>
                                <tr>
                                    <td><?php echo $item2['nombre']; ?></td>
                                    <td><?php echo $item2['referencia']; ?></td>
                                    <td><?php echo $item2['precio']; ?></td>
                                    <td>
                                        <form action="home.php?mod=ventas" method="post">
                                            <input type="number" name="id_producto" value="<?php echo $item2['id']; ?>" hidden />
                                            <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" type="submit" name="btnProductoSeleccionado">
                                                <i class="fas fa-sign-in-alt"></i>&nbsp;
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        }
        ?>
        <?php
        if ((isset($_POST['btnProductoSeleccionado'])) && ($stock > 0) ) {
            $producto = $_POST['id_producto'];
            $array_producto = $resultado->read_producto('', $producto);
            foreach ($array_producto as $item3) {
                $cantidad = count($array_producto);
        ?>
                <form action="home.php?mod=ventas" method="POST" class="mt-4" oninput="costo.value=parseInt(valor1.value) * parseInt(valor2.value)">
                    <div class="container d-flex justify-content-end pt-2">
                        <h3><i class="fas fa-shopping-cart"></i>&nbsp;Factura No. 
                        <?php
                            $factura = new Consulta();
                            $sql = "select numeroFactura from ventas order by id desc limit 1;";
                            $result_factura = $factura->cargar_Numerofactura($sql);
                            $cantidad = count($result_factura);
                            if ($cantidad == 0){
                                echo $numeroFactura = 1;
                            }else{
                                foreach ($result_factura as $item4) {
                                $cantidad = count($result_factura);
                                    echo $numeroFactura = $item4['numeroFactura'] + 1;
                                }
                            }
                        ?>
                        <input type="number" name="txtnumerofactura" value="<?php echo $numeroFactura; ?>" hidden>
                    </h3>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="Producto" class="form-label">Producto</label>
                                <input type="text" class="form-control" name="txtnombre" value="<?php echo $item3['nombre']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="Referencia" class="form-label">Referencia</label>
                                <input type="text" class="form-control" name="txtreferencia" value="<?php echo $item3['referencia']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="Precio" class="form-label">Precio</label>
                                <input type="number" class="form-control" name="txtprecio" id="valor1" value="<?php echo $item3['precio']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="Cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="valor2" name="txtcantidad" pattern="[0-9]" required>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="Categoria" class="form-label">Valor Total</label>
                                <input type="number" class="form-control" id="total" name="total" name="txtvalorVenta" readonly>
                                <output id="costo" name="costo" for='valor1 valor2' hidden></output>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-xs-12 col-sm-12 col-md-6 d-flex justify-content-end">
                            <button type="submit" name="btnGuardarVenta" class="btn btn-outline-primary btn-lg col-12 col-xs-12 col-sm-12 col-md-3">Guardar</button>
                            <input type="number" name="idUsuario" value="<?php echo $_SESSION['idUsuario']; ?>" hidden />
                            <input type="number" name="idProducto" value="<?php echo $item3['id']; ?>" hidden />
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                            <button type="button" onclick="refresh()" class="btn btn-outline-danger btn-lg col-12 col-xs-12 col-sm-12 col-md-3">Cancelar</button>
                        </div>
                    </div>
            <?php
                }
            }
            if(($stock <= 0) && (isset($_POST['btnProductoSeleccionado'])) ){
                echo '<script type="text/javascript">Swal.fire({
                    title: "El producto seleccionado no cuenta con stock disponible",
                    text: "No se pudo realizar la venta.",
                    type: "error",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Cerrar",
                    allowOutsideClick: false,
                    }).then((result) => {
                    if (result.value) {
                    window.location="home.php?mod=ventas";
                    }
                    });</script>';
            }
            ?>
                </form>
                <br>
                <div class="table-responsive-md  col-md-12">
                    <table class="table table-sm table-bordered table-striped text-center" id="ventas" data-page-length='5'>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No. Factura</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Referencia</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Valor Venta</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($array_ventas as $item) {
                                $cantidad = count($array_ventas);
                            ?>
                                <tr>
                                    <td><?php echo $item['numeroFactura']; ?></td>
                                    <td><?php echo $item['nombre']; ?></td>
                                    <td><?php echo $item['referencia']; ?></td>
                                    <td><?php echo $item['cantidad']; ?></td>
                                    <td><?php echo $item['valorVenta']; ?></td>
                                    <td><?php echo $item['fecha_venta']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
    </div>
    <script src="../vendor/js/jQuery1.9.1.min.js"></script>
    <script>
        function refresh(){
            window.location.reload();
        }

        $(document).ready(function() {
            $('#ventas').DataTable({
                searching: false,
                "lengthChange": false,
                "language": {
                    "decimal": ".",
                    "emptyTable": "No hay datos para mostrar",
                    "info": "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de todas las _MAX_ entradas)",
                    "infoPostFix": "",
                    "thousands": "'",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron resultados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": ordenar de manera Ascendente",
                        "sortDescending": ": ordenar de manera Descendente ",
                    }
                }
            });
        });

        $('#valor2').on('keyup', function(){
        var value = $("#costo").val();
        document.getElementById('total').value = value;
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
<?php
} else {
    header('location: ../index.php');
}
?>