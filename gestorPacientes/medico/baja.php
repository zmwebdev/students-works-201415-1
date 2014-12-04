<?php 
			session_start();
			//incluimos el archivo conexion.php para utilizar sus funciones
			include '../conexion.php';
			//guardo en variables el nombre de la bd y de la tabla que voy a utilizar
			conectar();
			selecDb();
			$dbTabla='usuarios';
			//guardo en una variable el dni guardado en la sesion
			$dni=$_SESSION['dni'];
			//guardo en $consulta la consulta que voy a ejecutar
			$consulta= "DELETE FROM $dbTabla WHERE dni ='$dni'";
			//ejecutamos la consulta
			if(mysql_query($consulta)){
				//si se ejecuta correctamente
			?>
				<script languaje="javascript">
					location.href = "../index.php";
				  	alert("Te has dado de baja!");
				</script>
			<?php 
			}else{
				//si no se ejecuta correctamente
				print "<h3>Error al darte de baja</h3> <br>";
			}
	?>