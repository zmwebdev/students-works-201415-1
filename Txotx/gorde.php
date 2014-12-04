<?php
	$iruzkina=$_GET['iruzkina'];
	$erabiltzailea=$_GET['erabiltzailea'];
	$data=$_GET['data'];
	$sagardotegia=$_GET['sagardotegia'];
	$herria=$_GET['herria'];

	$con=mysqli_connect("localhost", "root", "zubiri");
	/*$con = mysqli_connect(getenv('OPENSHIFT_MYSQL_DB_HOST'), getenv('OPENSHIFT_MYSQL_DB_USERNAME'), getenv('OPENSHIFT_MYSQL_DB_PASSWORD'), "", getenv('OPENSHIFT_MYSQL_DB_PORT')) or die("Error: " . mysqli_error($con));*/

	if(!$con){
		echo "Conexion fallida";
		exit;
	}

	/*mysqli_select_db($con, getenv('OPENSHIFT_APP_NAME')) or die("Error: " . mysqli_error($con));*/

	if(!mysqli_select_db("txotx", $con)){
		echo "Error seleccion base de datos";
		exit;
	}

	$sql="INSERT INTO iruzkinak (erabiltzailea, data, iruzkina,
		sagardotegia) VALUES ('$erabiltzailea', '$data', '$iruzkina', 
		'$sagardotegia');";
	$result=mysqli_query($con, $sql);

	/*if(!$result){
		echo "Error resultado";
		exit;
	}*/

	header("Location: sagardotegia.php?izena=$sagardotegia&herria=$herria");
	die();

	mysqli_close($con);
?>
