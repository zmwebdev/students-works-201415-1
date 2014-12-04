<html>
<head>
	
	<title>Lista de Pacientes</title>
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
		<link href="../css/main.css" rel="stylesheet" media="screen">
	
	
</head>
<body id="lista">
	<section class="container">
		<div class="content row">
			<?php include "../componentes/headerMedico.php"?>
		</div>
		<div class="content row">
			<div class="table table-responsive col-sm-6 col-md-6">
				<table class="table table-hover">
					<tr class="info"><td>DNI</td><td>NOMBRE</td><td>APELLIDOS</td><td>LOCALIDAD</td><td>TELEFONO</td><td>HISTORIAL</td></tr>
					<?php include "listarPacientes2.php"?>
				</table>
			</div>
		</div>
		<div class="content row">
		<?php include "../componentes/footer.php"; ?>
		</div>
	</section>

    <script src="../js/miapp.js"></script>
</body>
</html>
