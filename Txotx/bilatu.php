<html>
<head>
	<link rel="stylesheet" href="bilatu.css"/>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#izena').click(function(){
				$('bilatu.php',{'#izena':$(this).text()},function(data){
					$('#sagartotegia').load (sagardotegia.php);
				});
				return false;
			});
		}) ;
	</script>
</head>
<body>
<header id="registro">
	<ul id="hizkuntzak">
		<li><a href="">eu</a></li>
		<li>|</li>
		<li><a href="">es</a></li>
	</ul>
	<ul id="top_header">
		<li><a href="">Sagardotegiak</a></li>
		<li><a href="index.html">Hasiera</a></li>
	</ul>
</header>
<?php
	$herria=$_GET["herria"];
?>
<div id="menu_txikia">
	<form action="index.html" method="post">
		<input id="bilatu" type="submit" name="herria" value="Bilatzailea">
	</form>
</div>
	<div id="header">
		<img id="logo" src="img/logo.png"/>
		<h1><?php echo $herria ?></h1>
	</div>

<?php
	$con=mysqli_connect("localhost", "root", "zubiri","txotx");
	/*$con = mysqli_connect(getenv('OPENSHIFT_MYSQL_DB_HOST'), getenv('OPENSHIFT_MYSQL_DB_USERNAME'), getenv('OPENSHIFT_MYSQL_DB_PASSWORD'), "", getenv('OPENSHIFT_MYSQL_DB_PORT')) or die("Error: " . mysqli_error($con));*/

	if(!$con){
		echo "Conexion fallida";
		exit;
	}
	
	/*mysqli_select_db($con, getenv('OPENSHIFT_APP_NAME')) or die("Error: " . mysqli_error($con));*/

	/*if(!mysql_select_db("txotx", $con)){
		echo "Error seleccion base de datos";
		exit;
	}*/

	$sql="SELECT idherriak FROM herriak WHERE izena='".$herria."';";
	$result=mysqli_query($con, $sql);

	/*if(!$result){
		echo "Error resultado";
		exit;
	}*/

	$idherria=mysqli_fetch_array($result);
	$id=$idherria['idherriak'];

	$sql="SELECT izena FROM sagardotegiak WHERE herria='".$id."';";
	$result=mysqli_query($con, $sql);

	if(!mysqli_num_rows($result)){
		echo "Ez dago sagardotegirik";
	}
	else{
		while($row=mysqli_fetch_array($result)){
?>
			<div id="izena">
				<?php
					$izena=$row['izena'];
				?>
				<form action="sagardotegia.php" method="get">
					<input type="hidden" name="herria" value="<?php echo $herria ?>">
					<input id="sagar_ize" type="submit" name="izena" 
					value="<?php echo $izena ?>">
				</form>
			</div>
<?php
		}
	}
	mysqli_close($con);
?>	
</body>
</html>
