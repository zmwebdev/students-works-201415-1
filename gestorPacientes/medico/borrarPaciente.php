<html>
<head>
	<title>Borrar Pacientes</title>
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
		<?php 
		if(isset($_POST['borrar'])){
			session_start();
			if(!empty($_POST['dni_paciente'])){
				//incluimos el archivo conexion.php para utilizar sus funciones
				include '../conexion.php';
				//llamo a las funciones para conectarme a la bd y seleccionar la bd
				conectar();
				selecDb();
				//guardo en una variable el nombre de la tabla que voy a usar
				$dbTabla="pacientes";
				//guardo en variables el dni guardado en la sesion y el dni introducido en el formulario
				$dni_medico=$_SESSION['dni'];
				$dni_paciente=$_POST['dni_paciente'];
				//guardo en $consulta la consulta que voy a ejecutar
				$consulta="DELETE FROM $dbTabla 
							WHERE (dni_medico='$dni_medico') AND (dni_paciente='$dni_paciente')";
				//ejecutamos la consulta
				if(mysql_query($consulta)){
					//si se ejecuta correctamente
					print "<h3>Registro borrado</h3> <br>";
				}else{
					//si no se ejecuta correctamente
					print "<h3>Registro  no borrado</h3> <br>";
				}
				//cierro la conexion
				mysql_close();
			//si no ha introducido dni	
			}else{
				print "<h3>DNI Obligatorio</h3>";
			}
		//si no se ha pulsado el boton	
		}else{
?>
		<div class="content row col-sm-6 col-md-6" >
			<form id="formulario" role="form" method="post" action=<?php echo $_SERVER['PHP_SELF']?>>
				<div class="form-group">
			    	<label for="dni">Introduce el DNI del paciente que desea borrar:</label>
			    	<input type="text" class="form-control" id="dni_paciente" name="dni_paciente">
				</div>
				<input type="submit" class="btn btn-default" name="borrar" value="borrar">
			</form>
		</div>
	<?php 
		}
	?>
		<div class="content row">
			<?php include "../componentes/footer.php"; ?>
		</div>
	</section>

	
	<script src="../js/miapp.js"></script>
</body>
</html>
