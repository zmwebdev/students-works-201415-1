<!DOCTYPE html>
<html>
<head>
	<title>Osteopatia</title>
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
</head>
</head>
<body id="registro">
	<div class="container">
	  	<div class="row">
	  		<div class="col-sm-12">
	  			<img src="../img/columna.jpg" alt="columna" class="img-responsive"/>
	  		</div><!--end imagen zubiri -->
	  	</div>
	  	<h1>Registro</h1>
	  	<div class="row" id="main">
	  	
	  		<form id="formulario" class="form-horizontal col-sm-8" role="form" action="registrar.php" method="post">
			  <div class="form-group">
			    <label for="dni" class="col-sm-6 control-label">DNI:</label>
			    <div class="col-sm-6">
			      <input id="dni" type="text" class="form-control" name="dni">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="nombre" class="col-sm-6 control-label">Nombre:</label>
			    <div class="col-sm-6">
			      <input id="nombre" type="text" class="form-control" name="nombre">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="apellidos" class="col-sm-6 control-label">Apellidos:</label>
			    <div class="col-sm-6">
			      <input id="apellidos" type="text" class="form-control" name="apellidos">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="password" class="col-sm-6 control-label">Password</label>
			    <div class="col-sm-6">
			      <input id="password" type="password" class="form-control" name="password"/>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="localidad" class="col-sm-6 control-label">Localidad:</label>
			    <div class="col-sm-6">
			      <input id="localidad" type="text" class="form-control" name="localidad">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="telefono" class="col-sm-6 control-label">Telefono:</label>
			    <div class="col-sm-6">
			      <input id="telefono" type="text" class="form-control" name="telefono">
			    </div>
			  </div>
			  <div class="form-group">
                        <label for="tipoPersona" class="col-sm-6 control-label">Tipo</label>
                        <div class="col-sm-5">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tipoPersona" value="medico" /> Medico
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tipoPersona" value="paciente" /> Paciente
                                </label>
                            </div>
                        </div>
                    </div> 
			   <!--<div class="form-group">
			  <label for="tipoPersona" class="col-sm-6 control-label">Tipo:</label>
				  <label class="radio-inline">
	  				<input type="radio" name="tipoPersona" value="medico"> Medico
				  </label>
				  <label class="radio-inline">
	  				<input type="radio" name="tipoPersona" value="paciente"> Paciente
				  </label>
			  </div> -->
			  <div class="col-sm-offset-6 col-sm-6">
			  	<input id="submit_form" type="submit" class="btn btn-primary btn-lg btn-block" name="registrar" value="registrar"/>
			  </div>
			</form><!--end formulario-->
		</div><!--row del formulario+logo-->
		<div class="row">
			<?php include '../componentes/footer.php'?>
		</div>
	</div>
    <!--añadir mi javascript-->
    <script src="../js/miapp.js"></script>
</body>
</html>