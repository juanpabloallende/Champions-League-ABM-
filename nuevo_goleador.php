<?php
 require_once 'autoload.php';
 $auth = new Auth;
 $isauth = $auth->isAuthenticated();
 if(!$auth->isAuthenticated()) { 
    header('Location: ./../login.php');
    $_SESSION['error'] = 'Tenés que estar logueado para poder agregar goleadores';
    exit;
} 
 $posicion = new ListaPosiciones;
 $posiciones = $posicion->ListarPosiciones();
 $nacionalidad = new ListaNacionalidades;
 $nacionalidades = $nacionalidad->ListarNacionalidades();
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
<div id="container">    
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
        endif; 
        ?>
        <h2 class="text-center pt-4">Agregar goleador</h2>

        <form class="mb-4" action="acciones/nuevo_goleador.php" method="post">
            <div class="form-group col-10">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control">
            </div>
            <div class="form-group col-10">
                <label for="partidos">Partidos</label>
                <input type="text" id="partidos" name="partidos" class="form-control">
            </div>
            <div class="form-group col-10">
                <label for="goles">Goles</label>
                <input type="text" id="goles" name="goles" class="form-control">
            </div>
            <div class="form-group col-10">
				<label for="nacionalidad">Nacionalidad</label>
				<select id="nacionalidad" name="nacionalidad" class="form-control">
                    <?php
                        foreach ($nacionalidades as $nacionalidad) :
                    ?>
				    <option value="<?= $nacionalidad->getId(); ?>" >
                        <?= $nacionalidad->getNacionalidad(); ?>
                    </option>
                    <?php
                        endforeach;
					?>								
				</select>
			</div>						
			<div class="form-group col-10">
				<label for="posicion">Posición</label>
				<select id="posicion" name="posicion" class="form-control">
			    	<?php
                        foreach ($posiciones as $posicion) :
                    ?>
					<option value="<?=$posicion->getId(); ?>" >
                        <?= $posicion->getPosicion(); ?>
                    </option>
                    <?php
                        endforeach;
                    ?>								
				</select>
			</div>
            <div class="form-group col-10">
                <label for="debut">Año de debut</label>
                <input type="text" id="debut" name="debut" class="form-control">
            </div>
            <div class="form-group col-10">
                <label for="retiro">Año de retiro</label>
                <input type="text" id="retiro" name="retiro" class="form-control">
            </div>
            <div class="col-10">
                <button class="btn btn-primary btn-block" type="submit">Agregar goleador</button>
            </div>    
        </form>
    </div>
</div>    
    <script src="js/jquery-3.4.1.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
</body>
</html>
