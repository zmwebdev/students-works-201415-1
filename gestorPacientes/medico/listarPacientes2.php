<?php
	session_start();
	$dni_medico=$_SESSION['dni'];
	//incluimos el arhivo conexion.php para acceder a la bd
	include '../conexion.php';
	//llamo a las funciones para conectarme a la bd y seleccionar la bd
	conectar();
	selecDb();
	//guardo en una variable la tabla a usar
	$dbTabla="pacientes";
	//En otra variable guardo la consulta que voy a realizar
	$consulta="SELECT dni_paciente,nombre,apellidos,localidad,telefono,historial 
				FROM $dbTabla WHERE dni_medico='$dni_medico'";
	//ejecuto la consulta
	$result=mysql_query($consulta);
	//mientras haya registros los instroduzco en una tabla
	while($registro=mysql_fetch_row($result)){
		echo "<tr>";
		foreach ($registro as $clave){
			echo "<td>",$clave,"</td>";
		}
		echo "</tr>";
	}
	//cierro la conexion
	mysql_close();
?>

