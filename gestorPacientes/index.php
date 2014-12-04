<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/3.2.0/css/bootstrap.min.css"/>

    <!-- Include FontAwesome CSS if you want to use feedback icons provided by FontAwesome -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/fontawesome/4.1.0/css/font-awesome.min.css" />

    <!-- BootstrapValidator CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- BootstrapValidator JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js"></script>
    <link href="css/main.css" rel="stylesheet" media="screen">
  </head>
  <body>
  	<div class="container">
	  	<div class="row">
	  		<div class="col-sm-12">
	  			<img src="img/columna.jpg" alt="columna" class="img-responsive"/>
	  		</div><!--end imagen zubiri -->
	  	</div>
	  	<div class="row" id="main">
	  		<h1>LOGIN</h1>
	  		<form id="formulario" class="form-horizontal col-sm-8" role="form" action="comun/validar.php" method="post">
			  <div class="form-group">
			    <label for="dni" class="col-sm-6 control-label">DNI:</label>
			    <div class="col-sm-6">
			      <input id="dni" type="text" class="form-control" name="dni">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="password" class="col-sm-6 control-label">Password</label>
			    <div class="col-sm-6">
			      <input id="password" type="password" class="form-control" name="password"/>
			    </div>
			  </div>
			  <label class="col-sm-6 control-label"><a href="comun/registro.php">Registrarme</a></label>
			    <div class="col-sm-offset-6 col-sm-6">
			      <input id="submit_form" type="submit" class="btn btn-primary btn-lg btn-block" name="entrar" value="entrar"/>
			    </div>
			</form><!--end formulario-->
		</div><!--row del formulario+logo-->
		<div class="row">
			<?php include 'componentes/footer.php'?>
		</div>
	</div>

    <!--añadir mi javascript-->
   <script src="js/miapp.js"></script>
  </body>
</html>