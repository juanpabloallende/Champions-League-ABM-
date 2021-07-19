<?php
require './../autoload.php';

//Captura de datos

$id = $_POST['id'];

$goleador = new Goleador();
$exito = $goleador->eliminar($id);
if($exito) {
    header('Location: ./../index.php');
    $_SESSION['exito'] = 'El goleador se eliminó con éxito';
} else {
    header('Location: ./../index.php');
    $_SESSION['error'] = 'Hubo un error. Intentá de nuevo';
}
