<html>
<body>
<?php

	$user=$_POST["user"];
	$pass=$_POST["pass"];

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

	$sql="SELECT erabiltzailea, pasahitza FROM erabiltzaileak;";
	$result=mysqli_query($con, $sql);

	if(!$result){
		echo "Error resultado";
		exit;
	}
	$encontrado;
	while($row=mysqli_fetch_array($result)){
		//$row=mysql_fetch_array($result);
		if($row['erabiltzailea']==$user && $row['pasahitza']==$pass){
			GLOBAL $encontrado;
			$encontrado=true;
			break;
		}
	}
	
	if($encontrado==true){
		echo "Ongi etorri ".$user;
	}else{
		echo "Erabiltzaile hori ez da existitzen edo datuak gaizki daude.";
	}
	mysqli_close($con);
?>
</body>
</html>
