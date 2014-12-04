<?php include('header.php'); ?>

<!-- separacion entre PHP y HTML -->
<h2><?php echo $_SESSION['user_name']; ?> <?php echo FRASE_EDIT_TUS_DATOS; ?></h2>

<!-- formulario para editar el nombre de usuario  -->
<form method="post" action="edit.php" name="user_edit_form_name">
    <label for="user_name"><?php echo FRASE_NUEVO_USUARIO; ?></label>
    <input id="user_name" type="text" name="user_name" pattern="[a-zA-Z0-9]{2,64}" required /> (<?php echo FRASE_ACTUAL; ?>: <?php echo $_SESSION['user_name']; ?>)
    <input type="submit" name="user_edit_submit_name" value="<?php echo FRASE_CAMBIO_USUARIO; ?>" />
</form><hr/>

<!-- formulario para editar el mail -->
<form method="post" action="edit.php" name="user_edit_form_email">
    <label for="user_email"><?php echo FRASE_NUEVO_EMAIL; ?></label>
    <input id="user_email" type="email" name="user_email" required /> (<?php echo FRASE_ACTUAL; ?>: <?php echo $_SESSION['user_email']; ?>)
    <input type="submit" name="user_edit_submit_email" value="<?php echo FRASE_CAMBIO_EMAIL; ?>" />
</form><hr/>

<!-- formulario para editar la contraseña -->
<form method="post" action="edit.php" name="user_edit_form_password">
    <label for="user_password_old"><?php echo FRASE_ANTIGUO_PASS; ?></label>
    <input id="user_password_old" type="password" name="user_password_old" autocomplete="off" />

    <label for="user_password_new"><?php echo FRASE_NUEVO_PASS; ?></label>
    <input id="user_password_new" type="password" name="user_password_new" autocomplete="off" />

    <label for="user_password_repeat"><?php echo FRASE_NUEVO_PASS_REPETIR; ?></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" autocomplete="off" />

    <input type="submit" name="user_edit_submit_password" value="<?php echo FRASE_CAMBIO_PASS; ?>" />
</form><hr/>

<!-- Enlace "atras" -->
<a href="index.php"><?php echo FRASE_ATRAS_AL_LOGIN; ?></a>

<?php include('footer.php'); ?>
