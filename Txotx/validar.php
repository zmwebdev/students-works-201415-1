<?php
	$erabiltzailea=$_GET['erabiltzailea'];
	$pasahitza=$_GET['pasahitza'];
	$iruzkina=$_GET['iruzkina'];
	$data=$_GET['data'];
	$sagardotegia=$_GET['izena'];
	$herria=$_GET['herria'];

	/*$con=mysql_connect("localhost", "root", "zubiri");*/
	$con = mysqli_connect(getenv('OPENSHIFT_MYSQL_DB_HOST'), getenv('OPENSHIFT_MYSQL_DB_USERNAME'), getenv('OPENSHIFT_MYSQL_DB_PASSWORD'), "", getenv('OPENSHIFT_MYSQL_DB_PORT')) or die("Error: " . mysqli_error($con));

	/*if(!$con){
		echo "Conexion fallida";
		exit;
	}*/

	mysqli_select_db($con, getenv('OPENSHIFT_APP_NAME')) or die("Error: " . mysqli_error($con));

	/*if(!mysql_select_db("txotx", $con)){
		echo "Error seleccion base de datos";
		exit;
	}*/

	$sql="SELECT erabiltzailea, pasahitza FROM erabiltzaileak 
		WHERE erabiltzailea='".$erabiltzailea."';";
	$result=mysqli_query($con, $sql);
	$row=mysqli_fetch_array($result);

	if($row['erabiltzailea']==$erabiltzailea&&$row['pasahitza']==$pasahitza){
		header("Location: gorde.php?iruzkina=$iruzkina&erabiltzailea=$erabiltzailea&data=$data&sagardotegia=$sagardotegia&herria=$herria");
	}
	else{
		header ("Location: sagardotegia.php?msg=error&izena=$sagardotegia&herria=$herria"); 
  		exit;
	}
	mysqli_close($con);
?>
