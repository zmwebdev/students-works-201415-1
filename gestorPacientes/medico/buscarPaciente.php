<html>
<head>
	<title>Busqueda de Pacientes</title>
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
<body>
	<section class="container">
		<div class="content row">
			<?php include "../componentes/headerMedico.php"?>
		</div>
		<div class="row col-sm-6 col-md-6" >
			<form id="formulario" role="form" method="post" action="buscarPaciente2.php">
				<div class="form-group">
			    	<label for="dni">Introduce el DNI del paciente que desea buscar:</label>
			    	<input type="text" class="form-control" id="dni_paciente" name="dni_paciente">
				</div>
				<input type="submit" class="btn btn-default" name="buscar" value="buscar">
			</form>
		</div>
		<div class="content row">
			<?php include "../componentes/footer.php"; ?>
		</div>
	</section>


	<script src="../js/miapp.js"></script>
</body>
</html>