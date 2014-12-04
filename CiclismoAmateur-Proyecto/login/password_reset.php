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

// incluye PHPMailer
require_once('librerias/PHPMailer.php');

// carga la clase Login
require_once('clases/Login.php');

// crea el objeto Login
$login = new Login();

// el usuario ha introducido correctamente una nueva contraseña
// se muestra la pagina index
if ($login->passwordResetOk() == true && $login->passResetLinkOk() != true) {
    include("vistas/no_logeado.php");

} else {
    // muestra el formulario de peticion de reseteo de contraseña o escribe nueva contraseña
        include("vistas/password_reset.php");
}
