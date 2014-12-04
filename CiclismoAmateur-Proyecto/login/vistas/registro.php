<?php include('header.php'); ?>

<!-- muestra el formulario de registro -->
<?php if (!$registration->registro_ok && !$registration->verificacion_ok) { ?>
<form method="post" action="registro.php" name="registerform">
    <label for="user_name"><?php echo FRASE_REGISTRO_USUARIO; ?></label>
    <input id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />

    <label for="user_email"><?php echo FRASE_REGISTRO_MAIL; ?></label>
    <input id="user_email" type="email" name="user_email" required />

    <label for="user_password_new"><?php echo FRASE_REGISTRO_PASS; ?></label>
    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

    <label for="user_password_repeat"><?php echo FRASE_REGISTRO_PASS_REPETIR; ?></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />

    <label><p><?php echo FRASE_REGISTRO_CAPTCHA; ?></p></label>
    <img src="tools/showCaptcha.php" alt="captcha" />
    <input type="text" name="captcha" required />
    

    <input type="submit" name="register" value="<?php echo FRASE_REGISTRO; ?>" />
</form>
<?php } ?>

    <a href="index.php"><?php echo FRASE_ATRAS_AL_LOGIN; ?></a>

<?php include('footer.php'); ?>
