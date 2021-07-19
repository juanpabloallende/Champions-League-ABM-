<?php
require './../autoload.php';
$auth = new Auth;
$isauth = $auth->isAuthenticated();
if(!$auth->isAuthenticated()) { 
    header('Location: ./../login.php');
    $_SESSION['error'] = 'Tenés que estar logueado para poder editar';
    exit;
} 
// Validamos usando la clase Validator, que más adelante haremos desde 0 en clase.
$validator = new Validator($_POST, [
    // Aplicamos las reglas de validación definidas en la clase que queremos aplicar a cada clave del
    // array.
    'nombre'        => ['required', 'min:3'],
    'partidos'  => ['required', 'numeric'],
    'goles'      => ['required', 'numeric'],
    'debut'        => ['required', 'numeric', 'min:4'],
    'retiro'       => ['required', 'numeric', 'min:4'],
]);

if(!$validator->passes()) {
    header('Location: ./../nuevo_goleador.php');
    $_SESSION['error'] = 'Ocurrieron errores de validación';
    exit;
}

// Captura de datos.
$id           = $_POST['id'];
$nombre       = $_POST['nombre'];
$partidos     = $_POST['partidos'];
$goles        = $_POST['goles'];
$nacionalidad = $_POST['nacionalidad'];
$posicion     = $_POST['posicion'];
$debut        = $_POST['debut'];
$retiro       = $_POST['retiro'];

$goleador = new Goleador();
$exito = $goleador->editar([
    'id' => $id,
    'nombre' => $nombre,
    'partidos' => $partidos,
    'goles' => $goles,
    'nacionalidad' => $nacionalidad,
    'posicion' => $posicion,
    'debut' => $debut,
    'retiro' => $retiro,
    ]
);

if($exito) {
    header('Location: ./../index.php');
    $_SESSION['exito'] = 'El goleador se editó con éxito';
} else {
    header('Location: ./../editar_goleador.php');
    $_SESSION['error'] = 'Hubo un error. Intentá de nuevo';
}
