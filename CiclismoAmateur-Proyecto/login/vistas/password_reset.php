<?php include('header.php'); ?>

<?php if ($login->passResetLinkOk() == true) { ?>
<form method="post" action="password_reset.php" name="new_password_form">
    <input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
    <input type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />

    <label for="user_password_new"><?php echo FRASE_NUEVO_PASS; ?></label>
    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

    <label for="user_password_repeat"><?php echo FRASE_NUEVO_PASS_REPETIR; ?></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    <input type="submit" name="submit_new_password" value="<?php echo FRASE_ENVIAR_NUEVO_PASS; ?>" />
</form>
<!-- si no hay datos desde el mail de reset pass, se vuelve a mostrar el formulario de petición de nueva pass -->
<?php } else { ?>
<form method="post" action="password_reset.php" name="password_reset_form">
    <label for="user_name"><?php echo FRASE_PETICION_PASS_RESET; ?></label>
    <input id="user_name" type="text" name="user_name" required />
    <input type="submit" name="request_password_reset" value="<?php echo FRASE_RESET_PASS; ?>" />
</form>
<?php } ?>

<a href="index.php"><?php echo FRASE_ATRAS_AL_LOGIN; ?></a>

<?php include('footer.php'); ?>
