<?php
require_once __DIR__ . '/../autoload.php';

$auth = new Auth();
$auth->logout();

$_SESSION['exito'] = 'Cerraste sesión con éxito. Te esperamos de nuevo pronto.';
header("Location: ./../login.php");
