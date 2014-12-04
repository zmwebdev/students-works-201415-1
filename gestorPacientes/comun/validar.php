<?php
	//incluimos el archivo conexion.php para utilizar sus funciones
	include '../conexion.php';
	conectar();
	selecDb();
	//guardo en variable el nombre de la tabla que voy a utilizar
	$dbTabla="usuarios";
	//guardamos el dni y password introducidos en variables
	$dni = $_POST["dni"];   
	$password = $_POST["password"];

	//guardamos en una variable la consulta a realizar
	$result = mysql_query("SELECT * FROM $dbTabla WHERE dni = '$dni'");
	
	//Validamos si el dni existe en la base de datos o es correcto
	if($row = mysql_fetch_array($result)){     
	//Si el dni es correcto ahora validamos su contraseña
		if($row["password"] == $password){
		 	//si la contraseña es correcta
		 	//miramos el tipo
		 	switch ($row["tipo"]){
		 		//en el caso de que sea medico
		 		case "medico":
		 			//Creamos sesión
			 		session_start();  
			  		//Almacenamos el dni y tipo en una variable de sesión
			  		$_SESSION['dni'] = $dni;  
			  		$_SESSION['tipo']=$tipo; 
			  		//Redireccionamos a la pagina: indexMedico.php
			 		 header("Location: ../medico/indexMedico.php");
			 		 break;
		
		 		case "paciente":
		 			//Creamos sesión
			 		session_start();  
			  		//Almacenamos el dni y tipo en una variable de sesión
			  		$_SESSION['dni'] = $dni; 
			  		$_SESSION['tipo']=$tipo; 
			  		//Redireccionamos a la pagina: indexPacientes.php
			 		 header("Location: ../paciente/indexPacientes.php");  
			 		 break;
		 	}
		 }else{
	  	//En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a index.php
  ?>
   <script languaje="javascript">
	alert("Contraseña Incorrecta");
	location.href = "../index.php";
   </script>
  <?php    
	}
}else{
 //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
?>
 <script languaje="javascript">
  alert("El nombre de usuario es incorrecto!");
  location.href = "../index.php";
 </script>
<?php           
}

//cerramos la conexion a la base de datos
mysql_close();
?>