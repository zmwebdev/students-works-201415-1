<?php
/**
* Configuracion para la conexion con la BD
* Constantes del login en la BD
*
* @see http://php.net/manual/en/function.define.php
* Para saber porque se usa "define" en vez de "const" @see http://stackoverflow.com/q/2447791/1114320
*
* DB_HOST: normalmente localhost
* DB_NAME: nombre de la BD. 
* DB_USER: usuario para la BD. 
* DB_PASS: contraseña para el usuario
*/
define("BD_HOST", "127.6.140.130");
define("BD_NOMBRE", "ciclismo");
define("BD_USER", "adminHPKC5Gm");
define("BD_PASS", "76KX1FnE-ZLH");
define("BD_PUERTO", "3306");
 

/**
* Configuracion para los credenciales del servidor de mail
*
* Aqui se define como enviar los mails, usando Gmail como
* servidor de correo
*
*/
define("EMAIL_USA_SMTP", true);
define("EMAIL_SMTP_HOST", "ssl://smtp.gmail.com");
define("EMAIL_SMTP_AUTH", true);
define("EMAIL_SMTP_USERNAME", "clubciclistaermua@gmail.com");
define("EMAIL_SMTP_PASS", "zubiri2014");
define("EMAIL_SMTP_PUERTO", 465);
define("EMAIL_SMTP_ENCRIPCION", "ssl");


/**
 * Configuracion si se usa un servidor smtp
 * 
 * define("EMAIL_USA_SMTP", false);
 * define("EMAIL_SMTP_HOST", "tuhost");
 * define("EMAIL_SMTP_AUTH", true);
 * define("EMAIL_SMTP_USERNAME", "tunombre");
 * define("EMAIL_SMTP_PASS", "tupass");
 * define("EMAIL_SMTP_PUERTO", 465);
 * define("EMAIL_SMTP_ENCRIPCION", "ssl");
 */

/**
* Configuracion para el mail de reseteo de contraseña
* Hay que usar la ruta absoluta a password_reset.php
*/
define("EMAIL_PASSRESET_URL", "http://ciclismo-ciclismoermua.rhcloud.com/password_reset.php");
define("EMAIL_PASSRESET_FROM", "clubciclistaermua@gmail.com");
define("EMAIL_PASSRESET_NOMBRE", "Club Ciclista Ermua");
define("EMAIL_PASSRESET_ASUNTO", "Cambio de contraseña para ClubCiclistaErmua");
define("EMAIL_PASSRESET_CONTENIDO", "Por favor haz click en el siguiente enlace para cambiar tu contraseña:");

/**
* Configuracion para el mail de verificacion de datos
* Hay que usar la ruta absoluta a registro.php, 
*/
define("EMAIL_VERIFICACION_URL", "http://ciclismo-ciclismoermua.rhcloud.com/registro.php");
define("EMAIL_VERIFICACION_FROM", "clubciclistaermua@gmail.com");
define("EMAIL_VERIFICACION_NOMBRE", "Club Ciclista Ermua");
define("EMAIL_VERIFICACION_ASUNTO", "Activacion de cuenta para ClubCiclistaErmua");
define("EMAIL_VERIFICACION_CONTENIDO", "Por favor haz click en el siguiente enlace para activar tu cuenta:");

/**
* Configuracion del hashing
*
* Se llama a la funcion COST FACTOR. Este numero define el numero de veces de hashing en base 2
* Es decir, siendo 10 el COST FACTOR, seran 2^10. 
* Para mas informacion del mejor Cost factor:
* @see http://stackoverflow.com/q/4443476/1114320
*
* Esta constante se usa en las clases login y registro.
*/
define("HASH_COST_FACTOR", "10");