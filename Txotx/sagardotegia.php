<html>
<head>
	<link rel="stylesheet" href="sagardotegia.css"/>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
		function initialize(){
			var lat=43.2981;
			var lon=-1.8654;
			var myLatlng = new google.maps.LatLng(lat, lon);
			var myOptions = {
			  zoom: 8,
			  center: myLatlng,
			  mapTypeId: google.maps.MapTypeId.HYBRID
			};

			var map = new google.maps.Map($("#map_canvas").get(0), myOptions);

			var marker = new google.maps.Marker({
		    	position: myLatlng,
		    	map: map,
		    	title:"Sagardotegia"
		  	});
		}
	</script>
</head>
<body onload="initialize()">
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
	$izena=$_GET['izena'];
	$herria=$_GET['herria'];
?>
<div id="menu_txikia">
	<form action="bilatu.php" method="get">
		<input id="menu_txiki_herria" type="submit" name="herria" value="<?php echo $herria;?>">
		<a id="menu_txiki_izena"><?php echo ">".$izena ?></a>
	</form>
</div>
<div id="izena">
	<h1><?php echo $izena ;?></h1>
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

	$sql="SELECT deskribapena, telefonoa, email, web FROM sagardotegiak WHERE izena='".$izena."';";
	$result=mysqli_query($con, $sql);

	if(!$result){
		echo "Error resultado";
		exit;
	}

	while($row=mysqli_fetch_array($result)){
?>
		<div id="deskribapena">
			<?php
				echo "<br>";
				echo $row['deskribapena']."<br>";
				echo "Telefonoa: ".$row['telefonoa']."<br>";
				if($row['email']!=""){
					echo "Email: ".$row['email']."<br>";
				}
				if($row['web']!=""){
					echo "Web: ".$row['web']."<br>";
				} 
			?>
		</div>
<?php
	}	
?>	
	<div id="map_canvas" style="width: 640px; height: 400px;">gasdghsdfhadfhdash</div>
	<div id="iruzkin_header">
		<h3>Iruzkinak</h3>
	</div>
	<div id="iruzkinak">
		<?php
			/*$con=mysql_connect("localhost", "root", "zubiri");

			if(!$con){
				echo "Conexion fallida";
				exit;
			}

			if(!mysql_select_db("txotx", $con)){
				echo "Error seleccion base de datos";
				exit;
			}*/
			$sql="SELECT erabiltzailea, data, iruzkina FROM iruzkinak WHERE sagardotegia='".$izena."';";
			$result=mysqli_query($con, $sql);

			if(!$result){
				echo "Error resultado";
				exit;
			}
			while($row=mysqli_fetch_array($result)){
			?>
			<div id="nork">
				<?php echo $row['erabiltzailea']."    ".$row['data'];?>
			</div>
			<div id="iruzkina">
				<?php echo $row['iruzkina']."<br><br>";?>
			</div>
		<?php	
			}
		?>
	</div>
	<div>
		<form action="validar.php" method="get">
			<label id="okerra" color="red"></label>
			Erabiltzailea: <input type="text" name="erabiltzailea">
			<br>
			Pasahitza: <input type="password" name="pasahitza">
			<br>
			Iruzkina:<br><textarea name="iruzkina" rows="5" ></textarea>
			<br>
			<input type="hidden" name="izena" value="<?php echo $izena; ?>">
			<input type="hidden" name="herria" value="<?php echo $herria; ?>">
			<input type="hidden" name="data" 
			value="<?php echo date('Y-m-d H:i:s'); ?>">
			<input type="submit" value="Bidali" > 
		</form>
	</div>
<?php 
	if (isset($_GET['msg'])){
?>
	<script type="text/javascript">
		var e=document.getElementById(okerra);
		e.text("Erabiltzaile edo pasahitz okerra");
		//alert("Erabiltzaile edo pasahitz okerra");
	</script>

<?php
	}
	else{
?>
		<script type="text/javascript">
		var e=document.getElementById(okerra);
		e.text("");
		//alert("Erabiltzaile edo pasahitz okerra");
	</script>
<?php
	}
	mysqli_close($con);
?>
</body>
</html>
