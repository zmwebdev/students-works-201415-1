<?php 
	//si se pulsa el boton modificar
	if(isset($_POST['modificar'])){
		//inicio sesion
		session_start();
		//guardo en una variable el dni de la sesion
		$dni_medico=$_SESSION['dni'];
		//guardo en variables los datos del formulario
		$dni = $_POST['dni'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$localidad = $_POST['localidad'];
		$telefono = $_POST['telefono'];
		$historial = $_POST['historial'];
		//inluimos el fichero que hace la conexion a la bd
		include '../conexion.php';
		//llamo a las funciones para conectarme a la bd y seleccionarla
		conectar();
		selecDb();
		//guardo en una variable la tabla a usar
		$dbTabla='pacientes';
		//guardo en $consulta la consulta que se va a realizar
		$consulta = "UPDATE $dbTabla
		    SET nombre='$nombre', apellidos='$apellidos', localidad='$localidad',
		    telefono='$telefono', historial='$historial' 
		    WHERE (dni_paciente='$dni') AND (dni_medico='$dni_medico')";
		//ejecuto la consulta
		$result = mysql_query($consulta);
		//si la consulta se ejecuta bien
		if ($result) {
			//mensaje correcto
		    print "<h3>Registro modificado correctamente.</h3>";
		//sino    
		} else {
			//mensaje error
		    print "<h3>Error al modificar el registro.</h3>\n";
		}
		//cierro la conexion
		mysql_close();
	//si no se ha pulsado el boton	
	}else{
?>
	<label>Introduzca los datos del paciente a modificar</label>
			<form id="formulario" role="form" method="post" action=<?php echo $_SERVER['PHP_SELF']?>>
				<div class="form-group">
			    	<label for="dni">DNI:</label>
			    	<input type="text" class="form-control" id="dni" name="dni">
				</div>
				<div class="form-group">
			    	<label for="nombre">NOMBRE:</label>
			    	<input type="text" class="form-control" id="nombre" name="nombre">
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
				<input type="submit" class="btn btn-default" name="modificar" value="modificar"/>
			</form>
<?php		
	}
?> 