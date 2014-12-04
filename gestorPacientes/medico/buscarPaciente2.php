<html>
<head>
	<title>Busqueda de Pacientes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../assets/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
	<section class="container">
		<div class="content row">
			<?php include "../componentes/headerMedico.php"?>
		</div>
		<div class="table table-responsive col-sm-6 col-md-6">
			<table class="table table-hover">
				<tr class="info"><td>DNI</td><td>NOMBRE</td><td>APELLIDOS</td><td>LOCALIDAD</td><td>TELEFONO</td><td>HISTORIAL</td></tr>
<?php 
	//inicio sesion
	session_start();
	//guardo en variable el dni guardado en la sesion
	$dni_medico=$_SESSION['dni'];
	//si se pulsa el boton buscar
	if(isset($_POST['buscar'])){
		//incluimos el archivo conexion.php para utilizar sus funciones
		include '../conexion.php';
		//llamo a las funciones para conectarme a la bd y seleccionar la bd
		conectar();
		selecDb();
		//guardo en una variable el nombre de la tabla que voy a usar
		$dbTabla="pacientes";
		//guardo en una variable el dni introducido
		$dni_paciente=$_POST['dni_paciente'];
		//guardo en $consulta la consulta que voy a ejecutar
		$consulta="SELECT dni_paciente,nombre,apellidos,localidad,telefono,historial
		 			FROM $dbTabla WHERE dni_medico='$dni_medico' AND dni_paciente='$dni_paciente'";
		//ejecuto la consulta
		$result=mysql_query($consulta);
		//mientras haya un registro
		while ($registro = mysql_fetch_row($result)){
			//imprimo una tabla con el valor del registro
			echo "<tr>";
			foreach($registro  as $valor){
				echo "<td>",$valor,"</td>";
 			}
 			echo "</tr>";
		}
		//cierro conexion
		mysql_close();			 
	}
?>
			</table>
		</div>
		<div class="content row">
			<?php include "../componentes/footer.php"; ?>
		</div>
	</section>

	<script src="../assets/js/jquery.js"></script>
	<script src="../assets/js/bootstrap.js"></script>
	<script src="../js/app.js"></script>
</body>
</html>
