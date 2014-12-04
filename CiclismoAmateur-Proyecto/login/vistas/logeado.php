<?php include('header.php'); ?>

<?php

echo FRASE_ESTAS_LOGEADO_COMO . $_SESSION['user_name'] . "<br />";

echo FRASE_IMAGEN_PERFIL . '<br/>' . $login->user_gravatar_imagen_tag;
?>

<div>
    <a href="index.php?logout"><?php echo FRASE_LOGOUT; ?></a>
    <a href="edit.php"><?php echo FRASE_EDIT_DATO_USUARIO; ?></a>
</div>

<?php include('footer.php'); ?>

