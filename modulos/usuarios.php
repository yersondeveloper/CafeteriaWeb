<?php
error_reporting(E_ALL ^ E_NOTICE);
if (isset($_SESSION['usuario'])) {

?>
    <?php
    require_once('../crud/read.php');
    require_once('../crud/getcreate.php');

    $verificar = new Conexion();
    $resultado = new Consulta();
    $nombre = $_POST['txtBuscarUsuario'];
    $array_usuarios = $resultado->read_usuarios($nombre, $nombre);

    $perfil = new Consulta();
    $sql = "SELECT id, nombre FROM perfiles";
    $result_perfil = $perfil->cargar_perfil($sql);

    if (isset($_POST['btnModificarUsuario'])) {
        require_once('../crud/getupdate.php');
    }
    ?>
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 pb-3">
        <form action="home.php?mod=usuarios" method="POST">
            <div class="container text-center pb-3 mt-3">
                <h3><i class="fas fa-users"></i>&nbsp;GESTIÓN USUARIOS</h3>
            </div>
            <?php
            if (isset($_POST['btnModificar'])) {
                $id = $_POST['id_usuario'];
                $array_usuario = $resultado->read_usuario('', $id);
                foreach ($array_usuario as $item2) {
                    $cantidad = count($array_usuario);
            ?>
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label for="Nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="txtnombre" value="<?php echo $item2['nombre']; ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label for="Identificación" class="form-label">Identificación</label>
                                <input type="number" class="form-control" name="txtidentificacion" value="<?php echo $item2['identificacion']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="Perfil" class="form-label">Perfil</label>
                                <select class="form-select" name="cmbIdPerfil" required>
                                    <option value="">Seleccionar Perfil</option>
                                    <?php foreach ($result_perfil as $op) :
                                        if ($item2['id'] == $op['id']) {
                                            echo "<option value=" . $op['id'] . " selected>";
                                            echo $op['nombre'];
                                            echo "</option>";
                                        } else {
                                            echo "<option value=" . $op['id'] . ">";
                                            echo $op['nombre'];
                                            echo "</option>";
                                        }
                                    ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="Contraseña" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="txtpassword" value="<?php echo $item2['password']; ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4">
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
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                        <div class="mb-3">
                            <label for="Nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="txtnombre" required>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                        <div class="mb-3">
                            <label for="Identificación" class="form-label">Identificación</label>
                            <input type="number" class="form-control" name="txtidentificacion" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                        <div class="mb-3">
                            <label for="Perfil" class="form-label">Perfil</label>
                            <select class="form-select" name="cmbIdPerfil" required>
                                <option value="">Seleccionar Perfil</option>
                                <?php foreach ($result_perfil as $op) : ?>
                                    <option value="<?= $op['id'] ?>"><?= $op['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                        <div class="mb-3">
                            <label for="Contraseña" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control" name="txtpassword" required>
                                <div class="input-group-append">
                                    <button onclick="mostrarContrasena()" class="btn btn-outline-dark" type="button"><span class="fa fa-eye-slash icon"></span> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
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
                    <button type="submit" name="btnModificarUsuario" class="btn btn-outline-primary btn-lg col-12 col-xs-12 col-sm-12 col-md-3">Modificar</button>
                    <input type="number" name="id_usuario" value="<?php echo $item2['id']; ?>" hidden />
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                    <button type="button" onclick="refresh()" class="btn btn-outline-danger btn-lg col-12 col-xs-12 col-sm-12 col-md-3">Cancelar</button>
                </div>
                <?php
                } else {
                ?>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 d-flex justify-content-end">
                        <button type="submit" name="btnCrearUsuario" class="btn btn-outline-primary btn-lg col-12 col-xs-12 col-sm-12 col-md-3">Guardar</button>
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
        <form action="home.php?mod=usuarios" method="post" class="mb-3">
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
                                <input type="text" class="form-control" id="txtBuscar" name="txtBuscarUsuario" placeholder="Nombre o identificación">&nbsp;
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
        <div class="table-responsive-md col-md-12">
            <table class="table table-sm table-bordered table-striped text-center" id="usuarios" data-page-length='5'>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Identificación</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($array_usuarios as $item) {
                        $cantidad = count($array_usuarios);
                    ?>
                        <tr>
                            <td><?php echo $item['nombre']; ?></td>
                            <td><?php echo $item['identificacion']; ?></td>
                            <td><?php echo $item['perfil']; ?></td>
                            <td><?php
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
                                <form action="home.php?mod=usuarios" method="post">
                                    <input type="number" name="id_usuario" value="<?php echo $item['id']; ?>" hidden />
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

        function mostrarContrasena() {
            var tipo = document.getElementById("password");
            if (tipo.type == "password") {
                tipo.type = "text";
            } else {
                tipo.type = "password";
            }
        }

        $(document).ready(function() {
            $('#usuarios').DataTable({
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