<?php
if(!getenv('OPENSHIFT_MYSQL_DB_HOST')){
	function conectar(){
		$conexion=mysql_connect("localhost", "root", "") or die ("Error en la conexion");
		return $conexion;
	}
	function selecDb(){
		$db=mysql_select_db('gestorPacientes')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
		return $db;
	}
}else{
	// Database Connection Setting
	 /*define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	 
	 define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	 
	 define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	 
	 define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );*/
	
	 $server=getenv('OPENSHIFT_MYSQL_DB_HOST');
	 $user=getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	 $password=getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	 $db=getenv('OPENSHIFT_APP_NAME');
	function conectar(){
	$conexion=mysql_connect($server,$user,$password) or die(mysql_error());
	return $conexion;
	}
	function selecDb(){
	$db=mysql_select_db(DB_DATABASE) or die(mysql_error());
	return $db;
	}
}
?>