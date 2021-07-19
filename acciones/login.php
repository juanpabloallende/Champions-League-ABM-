<?php
require_once __DIR__ . '/../autoload.php';

$email = trim($_POST['email']);
$password = $_POST['password'];

// TODO: Validar...
$validator = new Validator($_POST, [
    'email'        => ['required', 'min:3'],
    'password'  => ['required', 'min:6'],
]);
if(!$validator->passes()) {
    header('Location: ./../login.php');
    $_SESSION['error'] = 'Ocurrieron errores de validación';
    exit;
}
$auth = new Auth();
if($auth->login($email, $password)) {
// Lo anterior lo podemos simplificar a...
//if( (new Auth())->login($email, $password) ) {
    // Está autenticado
    $_SESSION['exito'] = 'Iniciaste sesión con éxito.';
    header('Location: ./../index.php');
} else {
    // No está autenticado.
    $_SESSION['error'] = 'Las credenciales no coinciden con nuestros registros.';
    header('Location: ./../login.php');
}
