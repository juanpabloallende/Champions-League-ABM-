<?php
session_start();
spl_autoload_register(function($className) {
    // Armamos el "path" a la ruta donde debería estar la clase.
    $filepath = __DIR__ . "/classes/" . $className . ".php";

    // Preguntamos si existe ese archivo.
    if(file_exists($filepath)) {
        require $filepath;
    }
});
