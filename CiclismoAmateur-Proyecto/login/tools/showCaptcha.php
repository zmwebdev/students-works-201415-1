<?php

/**
 * Este fichero genera un captcha y lo guarda en $_SESSION['captcha']
 * y renderiza un captcha 'grafico' en el navegador.
 *
 * En la página se muestra de esta manera
 * <img src="tools/showCaptcha.php" />
 *
 */

// comprueba si la extension gd esta instalada
if (!extension_loaded('gd')) {
    die("GD no esta instalado");
}

session_start();

// longitud del captcha
$iCaptchaLength = 4;

// la siguientes letras quedan excluidas del captcha: I, O, Q, S, 0, 1, 5
$str_choice = 'ABCDEFGHJKLMNPRTUVWXYZ2346789';
$str_captcha = '';
// crea el captcha con las letras almacenadas en $str_choice
for ($i=0; $i < $iCaptchaLength; $i++) {
    do {
        $ipos = rand(0, strlen($str_choice) - 1);
    // comprueba si cada letra solo se usa una vez
    } while (stripos($str_captcha, $str_choice[$ipos]) !== false);

    $str_captcha .= $str_choice[$ipos];
}

// escribe el captcha en la variable SESSION
$_SESSION['captcha'] = $str_captcha;

// crea la imagen con la herramienta GD
$im = imagecreatetruecolor(150, 70);

$bg = imagecolorallocate($im, 255, 255, 255);
imagefill($im, 0, 0, $bg);

// crear el background
// @see http://php.net/manual/es/function.imagecolorallocate.php
for($i=0;$i<1000;$i++) {
    $lines = imagecolorallocate($im, rand(200, 220), rand(200, 220), rand(200, 220));
    $start_x = rand(0,150);
    $start_y = rand(0,70);
    $end_x = $start_x + rand(0,5);
    $end_y = $start_y + rand(0,5);
    imageline($im, $start_x, $start_y, $end_x, $end_y, $lines);
}

// crea las letras 
// para mas info
// @see php.net/manual/en/function.imagefttext.php
for ($i=0; $i < $iCaptchaLength; $i++) {
    $text_color = imagecolorallocate($im, rand(0, 100), rand(10, 100), rand(0, 100));
    // font-path relative to this file
    imagefttext($im, 35, rand(-10, 10), 20 + ($i * 30) + rand(-5, +5), 35 + rand(10, 30), $text_color, 'fonts/times_new_yorker.ttf', $str_captcha[$i]);
}

// previene la captura de la imagen (asi siempre se ve un captcha nuevo)
header('Content-type: image/png');
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, proxy-revalidate');

// envia la imagen al navegador y la borra del cache php
imagepng($im);
imagedestroy($im);

?>
