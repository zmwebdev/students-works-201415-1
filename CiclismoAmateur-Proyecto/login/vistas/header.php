<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <style type="text/css">
        /* just for the demo */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 10px;
        }
        label {
            position: relative;
            vertical-align: middle;
            bottom: 1px;
        }
        input[type=text],
        input[type=password],
        input[type=submit],
        input[type=email] {
            display: block;
            margin-bottom: 15px;
        }
        input[type=checkbox] {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<?php
// muestra posibles errores / feedback (objeto login)
if (isset($login)) {
    if ($login->errores) {
        foreach ($login->errores as $error) {
            echo $error;
        }
    }
    if ($login->mensajes) {
        foreach ($login->mensajes as $message) {
            echo $message;
        }
    }
}
?>

<?php
// muestra posibles errores / feedback (objeto registro)
if (isset($registration)) {
    if ($registration->errores) {
        foreach ($registration->errores as $error) {
            echo $error;
        }
    }
    if ($registration->mensajes) {
        foreach ($registration->mensajes as $message) {
            echo $message;
        }
    }
}
?>
