<?php
/**
*	Mensajes en idioma castellano
*/
// clases de login y registro
define("MENSAJE_CUENTA_NO_ACTIVADA", "Tu cuenta no ha sido activada aun. Por favor, haga click en el enlace enviado a su mail.");
define("MENSAJE_CAPTCHA_ERROR", "Captcha erroneo");
define("MENSAJE_COOKIE_INVALIDA", "Cookie invalida");
define("MENSAJE_BD_ERROR", "Problema de conexion con la base de datos.");
define("MENSAJE_EMAIL_YA_EXISTE", "Este email ya esta registrado. Por favor use \"he olvidado la contrase&ntildea\" si no la recuerda.");
define("MENSAJE_EMAIL_CAMBIO_ERROR", "Error al cambiar el email.");
define("MENSAJE_EMAIL_CAMBIO_OK", "Email cambiado correctamente. Su nuevo email es ");
define("MENSAJE_EMAIL_VACIO", "El email no puede estar vacio");
define("MENSAJE_EMAIL_INVALIDO", "Formato de email incorrecto");
define("MENSAJE_EMAIL_COMO_ANTIGUO", "Ese email es el mismo que el actual. Por favor use uno diferente.");
define("MENSAJE_EMAIL_MUY_LARGO", "El email no puede ser mas largo de 64 caracteres");
define("MENSAJE_PARAMETRO_VACIO_EN_ENLACE", "Parametro vacio.");
define("MENSAJE_LOGOUT", "Ha cerrado la sesion.");

// Mensajes de fallo al logear
define("MENSAJE_LOGIN_ERROR", "Fallo en el login.");
define("MENSAJE_PASS_ANTIGUA_ERROR", "La contrase&ntildea antigua es incorrecta.");
define("MENSAJE_PASS_CONFIRMAR_ERROR", "La contrase&ntildea y la repeticion de contrase&ntildea no son iguales");
define("MENSAJE_PASS_CAMBIO_ERROR", "Error al cambiar la contrase&ntildea.");
define("MENSAJE_PASS_CAMBIO_OK", "Contrase&ntildea cambiada correctamente");
define("MENSAJE_PASS_VACIO", "El campo de la contrase&ntildea esta vacio");
define("MENSAJE_PASS_RESET_MAIL_ERROR", "No se pudo enviar el mail para el cambio de contrase&ntildea. Error: ");
define("MENSAJE_PASS_RESET_MAIL_ENVIADO", "Mail de cambio de contrase&ntildea correctamente enviado");
define("MENSAJE_PASS_MUY_CORTA", "La contrase&ntildea tiene que tener un minimo de 6 caracteres");
define("MENSAJE_PASS_ERROR", "Contrase&ntildea incorrecta. Intentelo de nuevo");
define("MENSAJE_PASS_ERROR_3_VECES", "Ha introducido una contrase&ntildea incorrecta en 3 o mas ocasiones. Intentelo de nuevo dentro de 30 segundos.");
define("MENSAJE_REGISTRO_ACTIVACION_ERROR", "No se pudo registrar");
define("MENSAJE_REGISTRO_ACTIVACION_OK", "Registro completo! Ahora se puede logear!");
define("MENSAJE_REGISTRO_ERROR", "Fallo al registrar. Intentelo de nuevo.");
define("MENSAJE_ENLACE_CADUCADO", "Enlace caducado. Use el enlace en en menos de una hora.");
define("MENSAJE_MAIL_VERIFICACION_ERROR", "No se ha podido enviar el mail de verificacion. Su cuenta no ha sido creada.");
define("MENSAJE_MAIL_VERIFICACION_NO_ENVIADO", "El mail de verificacion no ha sido enviado! Error: ");
define("MENSAJE_MAIL_VERIFICACION_ENVIADO", "Su cuenta ha sido creada correctamente y le hemos enviado un mail. Por favor, clique en el enlace adjunto al mail.");
define("MENSAJE_USUARIO_NO_EXISTE", "Ese usuario no existe");
define("MENSAJE_USUARIO_LONGITUD_ERROR", "El nombre de usuario tiene que tener entre 2 y 64 caracteres");
define("MENSAJE_USUARIO_CAMBIO_ERROR", "Fallo al renombrar el nombre de usuario");
define("MENSAJE_USUARIO_CAMBIO_OK", "El nombre de usuario ha sido cambiado correctamente. El nuevo nombre de usuario es ");
define("MENSAJE_USUARIO_VACIO", "El campo de usuario esta vacio");
define("MENSAJE_USUARIO_YA_EXISTE", "Ese usuario ya esta en uso. Por favor utilice otro.");
define("MENSAJE_USUARIO_INVALIDO", "El nombre de usuario no es el adecuado: utilice solo letras a-Z y numeros, entre 2 y 64 caracteres");
define("MENSAJE_USUARIO_COMO_ANTIGUO", "El usuario es identico al actual. Por favor elija otro.");

// vistas
define("FRASE_ATRAS_AL_LOGIN", "Volver al login");
define("FRASE_CAMBIO_EMAIL", "Cambiar mail");
define("FRASE_CAMBIO_PASS", "Cambiar contrase&ntilde;a");
define("FRASE_CAMBIO_USUARIO", "Cambiar usuario");
define("FRASE_ACTUAL", "actualmente");
define("FRASE_EDIT_DATO_USUARIO", "Editar datos de usuario");
define("FRASE_EDIT_TUS_DATOS", "Editar datos");
define("FRASE_OLVIDAR_PASS", "He olvidado la contrase&ntildea");
define("FRASE_LOGIN", "Log in");
define("FRASE_LOGOUT", "Log out");
define("FRASE_NUEVO_EMAIL", "Nuevo mail");
define("FRASE_NUEVO_PASS", "Nueva contrase&ntildea");
define("FRASE_NUEVO_PASS_REPETIR", "Repita la contrase&ntildea");
define("FRASE_NUEVO_USUARIO", "Nuevo usuario (el usuario no puede estar vacio y tiene que tener caracteres aZ y 2-64 caracteres)");
define("FRASE_ANTIGUO_PASS", "Contrase&ntildea antigua");
define("FRASE_PASS", "Contrase&ntildea");
define("FRASE_IMAGEN_PERFIL", "Imagen de perfil (para avatares personalizados visitar https://es.gravatar.com/ ):");
define("FRASE_REGISTRO", "Registro");
define("FRASE_REGISTRO_NUEVA_CUENTA", "Registrar nueva cuenta");
define("FRASE_REGISTRO_CAPTCHA", "Por favor ingrese los siguientes caracteres");
define("FRASE_REGISTRO_MAIL", "Mail del usuario (por favor ingrese una cuenta real, recibira un mail de verificacion con un enlace de activacion)");
define("FRASE_REGISTRO_PASS", "Contrase&ntildea (min. 6 caracteres!)");
define("FRASE_REGISTRO_PASS_REPETIR", "Repita la contrase&ntildea");
define("FRASE_REGISTRO_USUARIO", "Usuario (solo letras y numeros, entre 2 y 64 caracteres)");
define("FRASE_RECORDARME", "Recordarme (durante 2 semanas)");
define("FRASE_PETICION_PASS_RESET", "Peticion de cambio de contrase&ntildea. Ingrese su usuario y recibira un mail con instrucciones:");
define("FRASE_RESET_PASS", "Cambiar contrase&ntilde;a");
define("FRASE_ENVIAR_NUEVO_PASS", "Enviar nueva contrase&ntilde;a");
define("FRASE_USUARIO", "Usuario");
define("FRASE_ESTAS_LOGEADO_COMO", "Ha iniciado sesion como ");