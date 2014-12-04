<?php
	$izena=$_POST['izena'];
	$abizena=$_POST['abizena'];
	$email=$_POST['email'];
	$erabiltzailea=$_POST['user'];
	$pasahitza=$_POST['pass'];

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

	$sql="SELECT * FROM erabiltzaileak WHERE erabiltzailea='".$erabiltzailea."';";
	$result=mysqli_query($con, $sql);
	$row=mysqli_fetch_array($result);

	if($row['erabiltzailea']==$erabiltzailea || $row['email']==$email){
		echo "Jadanik badago erabiltzaile bat datu hoiekin.";
	}else{
		$sql="INSERT INTO erabiltzaileak (erabiltzailea, pasahitza, izena,
			abizena, email) VALUES ('$erabiltzailea', '$pasahitza', '$izena', 
			'$abizena', '$email');";
		$result=mysqli_query($con, $sql);

		echo "Erregistroa ondo burutu da";
		/*header("Location: index.html?var=1");
		die();*/
	}

	mysqli_close($con);
?>