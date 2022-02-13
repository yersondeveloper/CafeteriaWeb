<?php
    //Cerrar la sesion del usuario
    session_start();
    session_destroy();
    header('Location: index.php');

?>