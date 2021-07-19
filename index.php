<?php
require_once 'autoload.php';

$goleador = new Goleador;
$goleadores = $goleador->traerTodo();
$auth = new Auth;
$isauth = $auth->isAuthenticated();
if(!$auth->isAuthenticated()) { 
    header('Location: ./../login.php');
    $_SESSION['error'] = 'Tenés que estar logueado para ingresar al panel';
    exit;
} 
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UEFA Champions League</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="estilos.css"/>
</head>
<body>
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
                    <a class="nav-link" href="nuevo_goleador.php"> Agregar goleador</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="acciones/logout.php">Cerrar Sesión (<?= $auth->getUser()->getEmail();?>)</a>
                </li>
                <?php
                endif; ?>
            </ul>
        </div>
    </nav>
</header>    
    <div class="container mt-4">
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
        <h2 class="text-center mb-2 mt-5">Listado de máximos goleadores</h2>
        <div class="mb-3 mt-3">
            <a href="nuevo_goleador.php">Agregar goleador</a>
        </div>
        <main>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Número</th>
                    <th>Nombre</th>
                    <th>Partidos</th>
                    <th>Goles</th>
                    <th>Posición</th>
                    <th>Nacionalidad</th>
                    <th>Debut</th>
                    <th>Retiro</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($goleadores as $goleador): ?>
                <tr>
                    <td><?= $goleador->getId();?></td>
                    <td><?= $goleador->getNombre();?></td>
                    <td><?= $goleador->getPartidos();?></td>
                    <td><?= $goleador->getGoles();?></td>
                    <td><?= $goleador->getPosiciones();?></td>
                    <td><?= $goleador->getNacionalidades();?></td>
                    <td><?= $goleador->getDebut();?></td>
                    <td><?= $goleador->getRetiro();?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="editar_goleador.php?&id=<?= $goleador->getId(); ?>">Editar</a>                               
                                <form action="acciones/eliminar.php" method="post">
                                    <input type="hidden" name="id" value="<?= $goleador->getId();?>">
                                    <button type="submit" class="dropdown-item">Borrar</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
    <script src="js/jquery-3.4.1.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
</body>
</html>
