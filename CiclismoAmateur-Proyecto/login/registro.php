<?php

// comprueba la version de PHP
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Lo sentimos, esta app no funciona en versiones anteriores a PHP 5.3.7');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // si se usa PHP 5.3 o 5.4 se incluye la libreria
    require_once('librerias/password_compatibility_library.php');
}
// incluye the config
require_once('config/config.php');

// incluye el idioma
require_once('idiomas/es.php');

// incluye la libreria PHPMailer
require_once('librerias/PHPMailer.php');

// cargar la clase Registro
require_once('clases/Registro.php');

// crea el objeto Registration, este objeto se encarga de manejar todo
// todo lo que tenga que ver con el registro es suficiente con esta linea de codigo
$registration = new Registro();

// muestra la vista de registro(con el formulario de registro, y los mensajes/errores)
include("vistas/registro.php");
