<html>
<head>
	<title>Añadir Paciente</title>
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
<body id="anadir">
	<section class="container">
		<div class="content row">
			<?php include "../componentes/headerMedico.php"?>
		</div>
		<div class="row col-sm-6 col-md-6" >
		<?php
		session_start();
		if(isset($_POST['anadir'])){
			if(!empty($_POST['dni'])){
				//incluimos el archivo conexion.php para utilizar sus funciones
				include '../conexion.php';
				//llamo a las funciones para conectarme a la bd y seleccionar la bd
				conectar();
				selecDb();
				//guardo en una variable el nombre de la tabla que voy a usar
				$dbTabla="pacientes";
				//guardo en variables los datos que recojo del formulario
				$dni_medico=$_SESSION['dni'];
				$dni_paciente=$_POST['dni'];
				$nombre=$_POST['nombre'];
				$apellidos=$_POST['apellidos'];
				$localidad=$_POST['localidad'];
				$telefono=$_POST['telefono'];
				$historial=$_POST['historial'];
				//guardo en $consulta la consulta que voy a ejecutar
				$consulta="INSERT INTO $dbTabla (dni_medico,dni_paciente,nombre,apellidos,localidad,telefono,historial) VALUES ('$dni_medico','$dni_paciente','$nombre','$apellidos','$localidad','$telefono','$historial')";
				//ejecutamos la consulta
				if(mysql_query($consulta)){
					//si se ejecuta correctamente
					print "<h3>Registro añadido</h3> <br>";
				}else{
					//si no se ejecuta correctamente
					print "<h3>Registro  no añadido</h3> <br>";
				}
				//cierro la conexion
				mysql_close();
			//si no ha introducido el dni	
			}else{
				print "<h3>DNI Obligatorio</h3>";
			}
		//si no ha pulsado el boton	
		}else{
		?>
			<form id="formulario" role="form" method="post" action=<?php echo $_SERVER['PHP_SELF']?>>
				<div class="form-group">
			    	<label for="dni">DNI:</label>
			    	<input type="text" class="form-control" id="dni" name="dni">
				</div>
				<div class="form-group">
			    	<label for="nombre">NOMBRE:</label>
			    	<input  type="text" class="form-control" id="nombre" name="nombre">
			  	</div>
			  	<div class="form-group">
			    	<label for="apellidos">APELLIDOS:</label>
			    	<input type="text" class="form-control" id="apellidos" name="apellidos">
			  	</div>
			  	<div class="form-group">
			    	<label for="localidad">LOCALIDAD:</label>
			    	<input type="text" class="form-control" id="localidad" name="localidad">
			  	</div>
			  	<div class="form-group">
			    	<label for="telefono">TELEFONO:</label>
			    	<input type="text" class="form-control" id="telefono" name="telefono">
			  	</div>
			  	<div class="form-group">
			  		<label for="historial">HISTORIAL:</label>
			  		<textarea class="form-control" rows="3" name="historial"></textarea>
			  	</div>
				<input type="submit" class="btn btn-default" name="anadir" value="añadir">
			</form>
			<?php 
			}
			?>
		</div>
		<div class="content row">
		<?php include "../componentes/footer.php"; ?>
		</div>
	</section>
	
	
    <script src="../js/miapp.js"></script>
</body>
</html>
