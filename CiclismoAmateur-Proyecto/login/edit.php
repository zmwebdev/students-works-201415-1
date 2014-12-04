<?php

// comprueba la version de PHP
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Lo sentimos, esta app no funciona en versiones anteriores a PHP 5.3.7');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // si se usa PHP 5.3 o 5.4 se incluye la libreria
    require_once('librerias/password_compatibility_library.php');
}
// incluye config
require_once('config/config.php');

// incluye el idioma
require_once('idiomas/es.php');

// incluye librería PHPMailer
require_once('librerias/PHPMailer.php');

// carga Login
require_once('clases/Login.php');

// crea el objeto Login, este objeto se encarga de manejar todo
// el entramado de login/logout con lo que con esta linea es suficiente
$login = new Login();

// si esta logeado
if ($login->estaLogeado() == true) {
    include("vistas/edit.php");
} else {
    	//el usuario no esta logeado, se muestra la pagina correspondiente
    include("vistas/no_logeado.php");
}
