<?php
/**
* Maneja el registro de usuario
*/
class Registro
{
	/**
	* @var object $bd_conexion Conexion a la BD
	*/
	private $bd_conexion = null;
	/**
	 @var bool registro_ok estado del registro
	*/
	public $registro_ok = false;
	/**
	* @var bool verificacion_ok estado de la verificacion
	*/
	public $verificacion_ok = false;
	/**
	* @var array Mensajes de error
	*/
	public $errores = array();
	/**
	* @var array mensajes de exito/neutrales
	*/
	public $mensajes = array();
	
	/**
	* la funcion se inicia cuando haces "$registro = new Registro();"
	*/
	public function __construct(){
		session_start();
		// si tenemos una peticion POST se llama al metodo registerNewUser
		if (isset($_POST["register"])) {
			$this->registrarNuevoUser($_POST['user_name'], $_POST['user_email'], $_POST['user_password_new'], $_POST['user_password_repeat'], $_POST["captcha"]);
		// si tenemos una peticion GET se llama al metodo verifyNewUser
		} else if (isset($_GET["id"]) && isset($_GET["verification_code"])) {
			$this->verificarNuevoUser($_GET["id"], $_GET["verification_code"]);
		}
	}
	/**
	* Comprueba si esta abiera la conexion a la BD y la abre si no lo esta
	*/
	private function conexionBD(){
		// con conexion abierta
		if ($this->bd_conexion != null) {
			return true;
		} else {
			// crea una conexion a la BD, usando config/config.php
			try {

				// Genera una conexion a la BD, usando el conector PDO
				// @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
				// @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL
				$this->bd_conexion = new PDO('mysql:host='. BD_HOST .';port='. BD_PUERTO .';dbname='. BD_NOMBRE . ';charset=utf8', BD_USER, BD_PASS);
				return true;
			// conexion a la BD fallida
			} catch (PDOException $e) {
				$this->errores[] = MENSAJE_BD_ERRORR;
				return false;
			}
		}
	}
	/**
	* Maneja todo el proceso de registro. Comprueba todos los 
	* errores posibles y crea un nuevo usuario en la BD
	* cuando todo esta correcto
	*/
	private function registrarNuevoUser($user_name, $user_email, $user_password, $user_password_repeat, $captcha){
		// hacemos trim tanto al usuario como al mail
		$user_name = trim($user_name);
		$user_email = trim($user_email);
		// comprueba la validez de los datos introducidos
		if (strtolower($captcha) != strtolower($_SESSION['captcha'])) {
			$this->errores[] = MENSAJE_CAPTCHA_ERROR;
			} elseif (empty($user_name)) {
				$this->errores[] = MENSAJE_USUARIO_VACIO;
			} elseif (empty($user_password) || empty($user_password_repeat)) {
				$this->errores[] = MENSAJE_PASS_VACIO;
			} elseif ($user_password !== $user_password_repeat) {
				$this->errores[] = MENSAJE_PASS_NO_CONFIRMADO;
			} elseif (strlen($user_password) < 6) {
				$this->errores[] = MENSAJE_PASS_MUY_CORTA;
			} elseif (strlen($user_name) > 64 || strlen($user_name) < 2) {
				$this->errores[] = MENSAJE_USUARIO_LONGITUD_ERROR;
			} elseif (!preg_match('/^[a-z\d]{2,64}$/i', $user_name)) {
				$this->errores[] = MENSAJE_USUARIO_INVALIDO;
			} elseif (empty($user_email)) {
				$this->errores[] =  MENSAJE_MAIL_VACIO;
			} elseif (strlen($user_email) > 64) {
				$this->errores[] = MENSAJE_MAIL_MUY_LARGO;
			} elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
				$this->errores[] = MENSAJE_MAIL_INVALIDO;
			// si todo es correcto
			} else if ($this->conexionBD()) {
				// comprobar si existen el usuario o el mail
				$query_check_user_name = $this->bd_conexion->prepare('SELECT user_name, user_email FROM users WHERE user_name=:user_name OR user_email=:user_email');
				$query_check_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
				$query_check_user_name->bindValue(':user_email', $user_email, PDO::PARAM_STR);
				$query_check_user_name->execute();
				$result = $query_check_user_name->fetchAll();
			// si se los datos introducidos ya existen
			if (count($result) > 0) {
				for ($i = 0; $i < count($result); $i++) {
					$this->errores[] = ($result[$i]['user_name'] == $user_name) ? 
					MENSAJE_USUARIO_YA_EXISTE : MENSAJE_EMAIL_YA_EXISTE;
				}
			} else {
				// comprueba si esta definida la constante HASH_COST_FACTOR (lo hemos definido)
				// si no está definida ponemos a null
				$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
				// encripta la pass del usuario mediante la función password_hash() de PHP 5.5 (60 caracteres)
				// la constante PASSWORD_DEFAULT está definida por PHP 5.5 o por la libreria password_compatibility_library 
				// para versiones anteriores (hasta PHP 5.3.7)
				$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
				// genera un hash aleatorio para el mail de verififacion (40 char string)
				$user_activation_hash = sha1(uniqid(mt_rand(), true));
				// introduce los datos del nuevo usuario en la BD
				$query_new_user_insert = $this->bd_conexion->prepare('INSERT INTO users (user_name, user_password_hash, user_email, user_activation_hash, user_registration_ip, user_registration_datetime) VALUES(:user_name, :user_password_hash, :user_email, :user_activation_hash, :user_registration_ip, now())');
				$query_new_user_insert->bindValue(':user_name', $user_name, PDO::PARAM_STR);
				$query_new_user_insert->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
				$query_new_user_insert->bindValue(':user_email', $user_email, PDO::PARAM_STR);
				$query_new_user_insert->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
				$query_new_user_insert->bindValue(':user_registration_ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
				$query_new_user_insert->execute();
				// id del nuevo usuario
				$user_id = $this->bd_conexion->lastInsertId();
				if ($query_new_user_insert) {
				// envia mail de verificacion
					if ($this->enviarMailVerificacion($user_id, $user_email, $user_activation_hash)) {
					// cuando el mail ha sido enviado correctamente
						$this->mensajes[] = MENSAJE_MAIL_VERIFICACION_ENVIADO;
						$this->registro_ok = true;
					} else {
						// no se ha podido enviar el mail con lo que se borra la cuenta del usuario
						$query_delete_user = $this->bd_conexion->prepare('DELETE FROM users WHERE user_id=:user_id');
						$query_delete_user->bindValue(':user_id', $user_id, PDO::PARAM_INT);
						$query_delete_user->execute();
						$this->errores[] = MENSAJE_MAIL_VERIFICACION_ERROR;
					}
				} else {
					$this->errores[] = MENSAJE_REGISTRO_ERROR;
				}
			}
		}
	}
	/**
	* envia un mail a la cuenta de correo del usuario
	* @return boolean devuelve true si se ha enviado el mail, false e.c.c.
	*/
	public function enviarMailVerificacion($user_id, $user_email, $user_activation_hash){
		require_once ('librerias/class.smtp.php');
		$mail = new PHPMailer;
		// usa SMTP o  mail()
		if (EMAIL_USA_SMTP) {
			// Configura para usar SMTP
			$mail->IsSMTP();
			// Habilita autentificacion SMTP
			$mail->SMTPAuth = EMAIL_SMTP_AUTH;
			// Habilita la encripcion, normalmente SSL/TLS
			if (defined(EMAIL_SMTP_ENCRIPCION)) {
				$mail->SMTPSecure = EMAIL_SMTP_ENCRIPCION;
			}
			// Especifica el servidor 
			$mail->Host = EMAIL_SMTP_HOST;
			$mail->Username = EMAIL_SMTP_USERNAME;
			$mail->Password = EMAIL_SMTP_PASS;
			$mail->Port = EMAIL_SMTP_PUERTO;
			} else {
				$mail->IsMail();
			}
			$mail->From = EMAIL_VERIFICACION_FROM;
			$mail->FromName = EMAIL_VERIFICACION_NOMBRE;
			$mail->AddAddress($user_email);
			$mail->Subject = EMAIL_VERIFICACION_ASUNTO;
			$link = EMAIL_VERIFICACION_URL.'?id='.urlencode($user_id).'&verification_code='.urlencode($user_activation_hash);
			// the link to your register.php, please set this value in config/email_verification.php
			$mail->Body = EMAIL_VERIFICACION_CONTENIDO.' '.$link;
			if(!$mail->Send()) {
				$this->errores[] = MENSAJE_MAIL_VERIFICACION_NO_ENVIADO . $mail->ErrorInfo;
				return false;
			} else {
				return true;
			}
	}
	/**
	* Comprueba los codigos id/verificacion y 
	* pone a true(=1) la activacion del usuario en la BD
	*/
	public function verificarNuevoUser($user_id, $user_activation_hash){
		// si la conexion esta abierta
		if ($this->conexionBD()) {
			// actualiza los datos del usuario
			$query_update_user = $this->bd_conexion->prepare('UPDATE users SET user_active = 1, user_activation_hash = NULL WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash');
			$query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
			$query_update_user->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
			$query_update_user->execute();
			if ($query_update_user->rowCount() > 0) {
				$this->verificacion_ok = true;
				$this->mensajes[] = MENSAJE_REGISTRO_ACTIVACION_OK;
			} else {
				$this->errores[] = MENSAJE_REGISTRO_ACTIVACION_ERROR;
			}
		}
	}
}