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
    $array_productos = $resultado->read_productos($nombre, $nombre);

    if (isset($_POST['btnModificarProducto'])) {
        require_once('../crud/getupdate.php');
    }
    ?>
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 pb-3">
        <form action="home.php?mod=productos" method="POST">
            <div class="container text-center pb-3 mt-3">
                <h3><i class="fas fa-coffee"></i>&nbsp;GESTIÓN PRODUCTOS</h3>
            </div>
            <?php
            if (isset($_POST['btnModificar'])) {
                $id = $_POST['id_producto'];
                $array_producto = $resultado->read_producto('', $id);
                foreach ($array_producto as $item2) {
                    $cantidad = count($array_producto);
            ?>
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="Nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="txtnombre" value="<?php echo $item2['nombre']; ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="Referencia" class="form-label">Referencia</label>
                                <input type="text" class="form-control" name="txtreferencia" value="<?php echo $item2['referencia']; ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="Precio" class="form-label">Precio</label>
                                <input type="number" class="form-control" name="txtprecio" value="<?php echo $item2['precio']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-12 col-md-3">
                            <div class="mb-3">
                                <label for="Peso" class="form-label">Peso en gramos</label>
                                <input type="number" class="form-control" name="txtpeso" value="<?php echo $item2['peso']; ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-3">
                            <div class="mb-3">
                                <label for="Categoria" class="form-label">Categoria</label>
                                <input type="text" class="form-control" name="txtcategoria" value="<?php echo $item2['categoria']; ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-3">
                            <div class="mb-3">
                                <label for="Stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="txtstock" value="<?php echo $item2['stock']; ?>" required>
                            </div>
                        </div>
                        <?php
                            $perfil = $_SESSION['perfil'];
                        ?>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-3" <?php 
                            if ($perfil == 'Vendedor' && $item2['estado'] == "0"){
                                echo "hidden";
                            }
                        ?>>
                            <div class="mb-3">
                                <label for="Estado" class="form-label">Estado</label>
                                <select class="form-select" name="cmbEstado" required>
                                    <option value="">Seleccionar Perfil</option>
                                    <option value="1" <?php
                                                        if ($item2['estado'] == "1") {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>>Activo</option>
                                    <option value="0" <?php
                                                        if ($item2['estado'] == "0") {
                                                            echo 'selected="selected"';
                                                        } ?>>Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                        <div class="mb-3">
                            <label for="Nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="txtnombre" required>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                        <div class="mb-3">
                            <label for="Referencia" class="form-label">Referencia</label>
                            <input type="text" class="form-control" name="txtreferencia" required>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                        <div class="mb-3">
                            <label for="Precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="txtprecio" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-3">
                        <div class="mb-3">
                            <label for="Peso" class="form-label">Peso en gramos</label>
                            <input type="number" class="form-control" name="txtpeso" required>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-3">
                        <div class="mb-3">
                            <label for="Categoria" class="form-label">Categoria</label>
                            <input type="text" class="form-control" name="txtcategoria" required>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-3">
                        <div class="mb-3">
                            <label for="Stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" name="txtstock" required>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-3">
                        <div class="mb-3">
                            <label for="Estado" class="form-label">Estado</label>
                            <select class="form-select" name="cmbEstado" required>
                                <option value="">Seleccionar Estado</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="row justify-content-center align-items-center">
                <?php
                if (isset($_POST['btnModificar'])) {
                ?>
                <div class="col-12 col-xs-12 col-sm-12 col-md-6 d-flex justify-content-end">
                    <button type="submit" name="btnModificarProducto" class="btn btn-outline-primary btn-lg col-12 col-xs-12 col-sm-12 col-md-3">Modificar</button>
                    <input type="number" name="id_producto" value="<?php echo $item2['id']; ?>" hidden />
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                    <button type="button" onclick="refresh()" class="btn btn-outline-danger btn-lg col-12 col-xs-12 col-sm-12 col-md-3">Cancelar</button>
                </div>
                <?php
                } else {
                ?>
                <div class="col-12 col-xs-12 col-sm-12 col-md-6 d-flex justify-content-end">
                    <button type="submit" name="btnCrearProducto" class="btn btn-outline-primary btn-lg col-12 col-xs-12 col-sm-12 col-md-3">Guardar</button>
                    <input type="number" name="idUsuario" value="<?php echo $_SESSION['idUsuario']; ?>" hidden />
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                    <button type="reset" class="btn btn-outline-danger btn-lg col-12 col-xs-12 col-sm-12 col-md-3">Cancelar</button>
                </div>
                <?php
                }
                ?>
            </div>
        </form>
        <br>
        <form action="home.php?mod=productos" method="post" class="mb-1">
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
        <div class="table-responsive-md  col-md-12">
            <table class="table table-sm table-bordered table-striped text-center" id="productos" data-page-length='5'>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Referencia</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Peso (gr)</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($array_productos as $item) {
                        $cantidad = count($array_productos);
                    ?>
                        <tr>
                            <td><?php echo $item['nombre']; ?></td>
                            <td><?php echo $item['referencia']; ?></td>
                            <td><?php echo $item['precio']; ?></td>
                            <td><?php echo $item['peso']; ?></td>
                            <td><?php echo $item['categoria']; ?></td>
                            <td><?php echo $item['stock']; ?></td>
                            <td>
                                <?php
                                if ($item['estado'] == '1') {
                                    echo 'Activo';
                                }
                                ?>
                                <?php
                                if ($item['estado'] == '0') {
                                    echo 'Inactivo';
                                }
                                ?>
                            </td>
                            <td>
                                <form action="home.php?mod=productos" method="post">
                                    <input type="number" name="id_producto" value="<?php echo $item['id']; ?>" hidden />
                                    <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" type="submit" name="btnModificar">
                                        <i class="fas fa-edit"></i>&nbsp;
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
    <script src="../vendor/js/jQuery1.9.1.min.js"></script>
    <script>
        function refresh(){
            window.location.reload();
        }

        $(document).ready(function() {
            $('#productos').DataTable({
                searching: false,
                "lengthChange": false,
                "language": {
                    "decimal": ".",
                    "emptyTable": "No hay datos para mostrar",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
<?php
} else {
    header('location: ../index.php');
}
?>