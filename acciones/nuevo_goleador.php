<?php
require './../autoload.php';
$auth = new Auth;
$isauth = $auth->isAuthenticated();
if(!$auth->isAuthenticated()) { 
    header('Location: ./../nuevo_goleador.php');
    $_SESSION['error'] = 'Tenés que estar logueado para realizar esta acción';
    exit;
} 
// Validamos usando la clase Validator, que más adelante haremos desde 0 en clase.
$validator = new Validator($_POST, [
    // Aplicamos las reglas de validación definidas en la clase que queremos aplicar a cada clave del
    // array.
    'nombre'        => ['required', 'min:3'],
    'partidos'  => ['required', 'numeric'],
    'goles'      => ['required', 'numeric'],
    'debut'        => ['required', 'numeric'],
]);

if(!$validator->passes()) {
    header('Location: ./../nuevo_goleador.php');
    $_SESSION['error'] = 'Ocurrieron errores de validación';
    exit;
}

// Captura de datos.
$nombre       = $_POST['nombre'];
$partidos     = $_POST['partidos'];
$goles        = $_POST['goles'];
$nacionalidad = $_POST['nacionalidad'];
$posicion     = $_POST['posicion'];
$debut        = $_POST['debut'];
$retiro       = $_POST['retiro'];

$goleador = new Goleador();
$exito = $goleador->crear([
    'nombre' => $nombre,
    'partidos' => $partidos,
    'goles' => $goles,
    'posicion' => $posicion,
    'nacionalidad' => $nacionalidad,
    'debut' => $debut,
    'retiro' => $retiro,
    ]
);

if($exito) {
    header('Location: ./../index.php');
    $_SESSION['exito'] = 'El goleador se agregó con éxito';
} else {
    header('Location: ./../nuevo_goleador.php');
    $_SESSION['error'] = 'Hubo un error. Intentá de nuevo';
}
