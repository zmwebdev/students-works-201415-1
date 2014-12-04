<?php include('header.php'); ?>

<form method="post" action="index.php" name="loginform">
    <label for="user_name"><?php echo FRASE_USUARIO; ?></label>
    <input id="user_name" type="text" name="user_name" required />
    <label for="user_password"><?php echo FRASE_PASS; ?></label>
    <input id="user_password" type="password" name="user_password" autocomplete="off" required />
   
    <!-- TODO darle utilidad a este checkbox (cookies)-->
    <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
    <label for="user_rememberme"><?php echo FRASE_RECORDARME; ?></label>
    <input type="submit" name="login" value="<?php echo FRASE_LOGIN; ?>" />
</form>


<a href="registro.php"><?php echo FRASE_REGISTRO_NUEVA_CUENTA; ?></a>
<a href="password_reset.php"><?php echo FRASE_OLVIDAR_PASS; ?></a>

<?php include('footer.php'); ?>