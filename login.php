<?php
require_once 'autoload.php';

$auth = new Auth();
$isauth = $auth->isAuthenticated();
if ($auth->isAuthenticated()):
header('Location:index.php');
exit;
endif;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="estilos.css"/>
</head>
<body>
<div id="contenedor">    
<header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light mb-3">
        <h1> <a href="#">UEFA Champions League</a></h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Abrir/cerrar menú de navegación">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php
                if(!$auth->isAuthenticated()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Iniciar Sesión</a>
                </li>
                <?php
                else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="acciones/logout.php">Cerrar Sesión (<?= $auth->getUser()->getEmail();?>)</a>
                </li>
                <?php
                endif; ?>
            </ul>
        </div>
    </nav>
</header>
<main>    
    <div class="container">
        <?php
        if(isset($_SESSION['exito'])):
            $exito = $_SESSION['exito'];
            unset($_SESSION['exito']);
            ?>
            <div class="alert alert-success alert-dismissible"><?= $exito;?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">&times;</span>
                </button> 
            </div>

        <?php
        endif; ?>
        <?php
        if(isset($_SESSION['error'])):
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
            <div class="alert alert-danger alert-dismissible"><?= $error;?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>           
        <?php
        endif; ?>

        <h2 class="text-center mb-3 pt-5">Iniciar Sesión</h2>

        <form action="acciones/login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
        </form>
    </div>
    </div>
</main>        
    <script src="js/jquery-3.4.1.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
</body>
</html>
