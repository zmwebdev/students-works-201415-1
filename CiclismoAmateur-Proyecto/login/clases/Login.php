<?php
/**
* Maneja el login/logout del usuario
*/
class Login{
	/**
	* @var object $bd_conexion Conexion a la BD
	*/
	private $bd_conexion = null;
	/**
	* @var int $user_id Id del usuario
	*/
	private $user_id = null;
	/**
	* @var string $user_name Nombre de usuario
	*/
	private $user_name = "";
	/**
	* @var string $user_email Mail del usuario
	*/
	private $user_email = "";
	/**
	* @var boolean $user_esta_logeado Estado del usuario en el login
	*/
	private $user_esta_logeado = false;
	/**
	* @var string $user_gravatar_imagen_url Imagen de perfil del usuario mediante url
	*/
	public $user_gravatar_imagen_url = "";
	/**
	* @var string $user_gravatar_imagen_tag Imagen de perfil del usuario mediante url con <img ... /> 
	*/
	public $user_gravatar_imagen_tag = "";
	/**
	* @var boolean $password_reset_link_ok Para el manejo de las vistas
	*/
	private $password_reset_link_ok = false;
	/**
	* @var boolean $password_reset_ok Para el manejo de vistas
	*/
	private $password_reset_ok = false;
	/**
	* @var array $errores Mensajes de error
	*/
	public $errores = array();
	/**
	* @var array $mensajes Mensajes neutrales/exito
	*/
	public $mensajes = array();
	/**
	* La funcion "__construct()" se inicia automaticamente
	* cuando se hace "$login = new Login();"
	*/
	public function __construct(){
		// crea sesion
		session_start();
		// comprueba las posibles acciones al logear
		// 1. logout 
		// 2. login via datos de sesion
		// por ejemplo cuando el usuario se logea y cierra la pestaña sin salir de la sesión y luego vuelve a entrar en la página
		// TODO 3. login via cookie	
		// 4. login via envio de datos, (el login mas usado, mediante formulario)
		
		// si el usuario quiere logout
		if (isset($_GET["logout"])) {
			$this->logout();
		// si el usuario tiene una sesion activa
		} elseif (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) {
			$this->loginViaSesion();
			// el usuario intenta cambiar su nombre de usuario
			if (isset($_POST["user_edit_submit_name"])) {
				$this->editUserName($_POST['user_name']);
			// el usuario intenta cambiar el mail
			} elseif (isset($_POST["user_edit_submit_email"])) {
				$this->editEmail($_POST['user_email']);
				// el usuario intenta cambiar la contraseña
			} elseif (isset($_POST["user_edit_submit_password"])) {
				$this->editPass($_POST['user_password_old'], $_POST['user_password_new'], $_POST['user_password_repeat']);
			}
		} elseif (isset($_POST["login"])) {
			if (!isset($_POST['user_rememberme'])) {
				$_POST['user_rememberme'] = null;
			}
			$this->loginViaForm($_POST['user_name'], $_POST['user_password'], $_POST['user_rememberme']);
		}
		// comprueba si el usuario ha enviado una peticion para cambiar la contraseña (se le envia un mail)
		if (isset($_POST["request_password_reset"]) && isset($_POST['user_name'])) {
			$this->resetPass($_POST['user_name']);
		} elseif (isset($_GET["user_name"]) && isset($_GET["verification_code"])) {
			$this->comprobarCodMailVerificacionValido($_GET["user_name"], $_GET["verification_code"]);
		} elseif (isset($_POST["submit_new_password"])) {
			$this->editNuevaPass($_POST['user_name'], $_POST['user_password_reset_hash'], $_POST['user_password_new'], $_POST['user_password_repeat']);
		}
		// Imagen de perfil
		if ($this->estaLogeado() == true) {
			$this->getImagenGravatarUrl($this->user_email);
		}
	}
	/**
	* Comprueba si hay una conexion abierta con la BD. 
	* Si no, la intenta abrir.
	* @return bool Estado de la conexion de la BD
	*/
	private function conexionBD(){
		// si ya existe una conexion
		if ($this->bd_conexion != null) {
			return true;
		} else {
			try {
			// Genera una conexion a la BD usando el conector PDO
			// @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
			// @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL says
			$this->bd_conexion = new PDO('mysql:host='. BD_HOST .';port='. BD_PUERTO .';dbname='. BD_NOMBRE . ';charset=utf8', BD_USER, BD_PASS);
			return true;
			} catch (PDOException $e) {
				$this->errores[] = MENSAJE_BD_ERROR . $e->getMessage();
			}
		}
			// retorno por defecto
			return false;
	}
	/**
	* Busca en la BD los datos del usuario mediante le parametro user_name
	* @return si el usuario existe los datos de usuario como objeto
	* @return false si no se ha encontrado el usuario
	*/
	private function getDatosUsuario($user_name){
		// si la conexion esta abierta
		if ($this->conexionBD()) {
			// toda la info del usuario
			$query_user = $this->bd_conexion->prepare('SELECT * FROM users WHERE user_name = :user_name');
			$query_user->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$query_user->execute();
			// la fila resultado
			return $query_user->fetchObject();
		} else {
			return false;
		}
	}
	/**
	* Logs in con los datos de sesion
	* En este punto ya estamos logeados con lo que el $_SESSION ya existe(tiene valor)
	*/
	private function loginViaSesion(){
		$this->user_name = $_SESSION['user_name'];
		$this->user_email = $_SESSION['user_email'];
		// ponemos el estado de login a true, ya que acabamos de comprobarlo para ello
		$this->user_esta_logeado = true;
	}
	
	/**
	* Logs in mediante el formulario del login
	* @param $user_name
	* @param $user_password
	* @param $user_rememberme
	*/
	private function loginViaForm($user_name, $user_password, $user_rememberme){
		if (empty($user_name)) {
			$this->errores[] = MENSAJE_USUARIO_VACIO;
		} else if (empty($user_password)) {
			$this->errores[] = MENSAJE_PASS_VACIO;
		// si el nombre de usuario y la contraseña no estan vacias
		} else {
		// el usuario se puede logear mediante el nombre o el mail
		// si no se ha insertado un formato de mail valido se intenta identificiar mediatne el user_name
			if (!filter_var($user_name, FILTER_VALIDATE_EMAIL)) {
				// coge toda la info del usuario concreto
				$result_row = $this->getDatosUsuario(trim($user_name));
			// isi el usuario ha insertado un formato de mail valido se intenta identificar mediante el user_mail
			} else if ($this->conexionBD()) {
				// coge toda la info del usuario
				$query_user = $this->bd_conexion->prepare('SELECT * FROM users WHERE user_email = :user_email');
				$query_user->bindValue(':user_email', trim($user_name), PDO::PARAM_STR);
				$query_user->execute();
				// fila resultado (como objeto)
				$result_row = $query_user->fetchObject();
			}
			// si el usuario no existe
			if (! isset($result_row->user_id)) {
				// mensaje de error al login
				$this->errores[] = MENSAJE_LOGIN_ERROR;
			} else if (($result_row->user_failed_logins >= 3) && ($result_row->user_last_failed_login > (time() - 30))) {
				$this->errores[] = MENSAJE_PASS_ERROR_3_VECES;
			} else if (! password_verify($user_password, $result_row->user_password_hash)) {
			// incrementa el contador de login falldo del usuario
				$sth = $this->bd_conexion->prepare('UPDATE users '
				. 'SET user_failed_logins = user_failed_logins+1, user_last_failed_login = :user_last_failed_login '
				. 'WHERE user_name = :user_name OR user_email = :user_name');
				$sth->execute(array(':user_name' => $user_name, ':user_last_failed_login' => time()));
				$this->errores[] = MENSAJE_PASS_ERROR;
			// cuenta no activada
			} else if ($result_row->user_active != 1) {
				$this->errores[] = MENSAJE_CUENTA_NO_ACTIVADA;
			} else {
				// escribe los datos del usuario en la sesion
				$_SESSION['user_id'] = $result_row->user_id;
				$_SESSION['user_name'] = $result_row->user_name;
				$_SESSION['user_email'] = $result_row->user_email;
				$_SESSION['user_logged_in'] = 1;
				// pone a true el estado del login
				$this->user_id = $result_row->user_id;
				$this->user_name = $result_row->user_name;
				$this->user_email = $result_row->user_email;
				$this->user_esta_logeado = true;
				$sth = $this->bd_conexion->prepare('UPDATE users '
				. 'SET user_failed_logins = 0, user_last_failed_login = NULL '
				. 'WHERE user_id = :user_id AND user_failed_logins != 0');
				$sth->execute(array(':user_id' => $result_row->user_id));
			
			}
		}
	}
	
	
	/**
	* Logout
	*/
	public function logout(){
		$_SESSION = array();
		session_destroy();
		$this->user_esta_logeado = false;
		$this->mesajes[] = MENSAJE_LOGOUT;
	}
	/**
	* Devuelve el estado actual del login del usuario
	* @return bool el estado de login del usuario
	*/
	public function estaLogeado(){
		return $this->user_esta_logeado;
	}
	/**
	* Edita el nombre de usuario mediante el formulario
	*/
	public function editUserName($user_name){
		$user_name = substr(trim($user_name), 0, 64);
		if (!empty($user_name) && $user_name == $_SESSION['user_name']) {
			$this->errores[] = MENSAJE_USUARIO_COMO_ANTIGUO;
			// el nombre no puede estar vacio y tiene que ser aZ09 y entre 2-64 caracteres
		} elseif (empty($user_name) || !preg_match("/^(?=.{2,64}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/", $user_name)) {
			$this->errores[] = MENSAJE_USUARIO_INVALIDO;
		} else {
			// comprueba si el usuario ya existe
			$result_row = $this->getDatosUsuario($user_name);
			if (isset($result_row->user_id)) {
				$this->errores[] = MENSAJE_USUARIO_YA_EXISTE;
			} else {
				// escribe los nuevos datos
				$query_edit_user_name = $this->bd_conexion->prepare('UPDATE users SET user_name = :user_name WHERE user_id = :user_id');
				$query_edit_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
				$query_edit_user_name->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
				$query_edit_user_name->execute();
				if ($query_edit_user_name->rowCount()) {
					$_SESSION['user_name'] = $user_name;
					$this->mensajes[] = MENSAJE_USUARIO_CAMBIO_OK . $user_name;
				} else {
					$this->errores[] = MENSAJE_USUARIO_CAMBIO_ERROR;
				}
			}
		}
	}
	/**
	* Edita el mail, mediante el formulario
	*/
	public function editEmail($user_email){
		$user_email = substr(trim($user_email), 0, 64);
		if (!empty($user_email) && $user_email == $_SESSION["user_email"]) {
			$this->errores[] = MENSAJE_EMAIL_COMO_ANTIGUO;
			// el mail no puede estar vacio y tiene que tener un formato valido
		} elseif (empty($user_email) || !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
			$this->errores[] = MENSAJE_EMAIL_INVALIDO;
		} else if ($this->conexionBD()) {
			// comprueba si el mail ya existe
			$query_user = $this->bd_conexion->prepare('SELECT * FROM users WHERE user_email = :user_email');
			$query_user->bindValue(':user_email', $user_email, PDO::PARAM_STR);
			$query_user->execute();
			// fila resultado(como objeto)
			$result_row = $query_user->fetchObject();
			// si el mail ya existe
			if (isset($result_row->user_id)) {
				$this->errores[] = MENSAJE_EMAIL_YA_EXISTE;
			} else {
				// escribe los datos en la BD
				$query_edit_user_email = $this->bd_conexion->prepare('UPDATE users SET user_email = :user_email WHERE user_id = :user_id');
				$query_edit_user_email->bindValue(':user_email', $user_email, PDO::PARAM_STR);
				$query_edit_user_email->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
				$query_edit_user_email->execute();
				if ($query_edit_user_email->rowCount()) {
					$_SESSION['user_email'] = $user_email;
					$this->mensajes[] = MENSAJE_EMAIL_CAMBIO_OK . $user_email;
				} else {
					$this->errores[] = MENSAJE_EMAIL_CAMBIO_ERROR;
				}
			}
		}
	}
	/**
	* Edita la contraseña del usuario, mediante el formulario
	*/
	public function editPass($user_password_old, $user_password_new, $user_password_repeat){
		if (empty($user_password_new) || empty($user_password_repeat) || empty($user_password_old)) {
			$this->errores[] = MENSAJE_PASS_VACIO;
		// si no repite la contraseña
		} elseif ($user_password_new !== $user_password_repeat) {
			$this->errores[] = MENSAJE_PASS_CONFIRMAR_ERROR;
		// la contraseña tiene que tener al menos 6 caracteres
		} elseif (strlen($user_password_new) < 6) {
			$this->errores[] = MENSAJE_PASS_MUY_CORTA;
		// todo ok
		} else {
			$result_row = $this->getDatosUsuario($_SESSION['user_name']);
			// si el usuario existe
			if (isset($result_row->user_password_hash)) {
				if (password_verify($user_password_old, $result_row->user_password_hash)) {
					$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
					$user_password_hash = password_hash($user_password_new, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
					// escribe el nuevo hash de usuario
					$query_update = $this->bd_conexion->prepare('UPDATE users SET user_password_hash = :user_password_hash WHERE user_id = :user_id');
					$query_update->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
					$query_update->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
					$query_update->execute();
					// Comprueba si se ha cambiado una fila
					if ($query_update->rowCount()) {
						$this->mensajes[] = MENSAJE_PASS_CAMBIO_OK;
					} else {
						$this->errores[] = MENSAJE_PASS_CAMBIO_ERROR;
					}
				} else {
					$this->errores[] = MENSAJE_PASS_ANTIGUA_ERROR;
				}
			} else {
				$this->errores[] = MENSAJE_USUARIO_NO_EXISTE;
			}
		}
	}
	/**
	* Reseteo de la password y enviar el correspondiente mail
	*/
	public function resetPass($user_name){
		$user_name = trim($user_name);
		if (empty($user_name)) {
			$this->errores[] = MENSAJE_USUARIO_VACIO;
		} else {
			// Genera un timestamp para saber exactamente cuando ha sido pedida la peticion
			// es un integer
			$temporary_timestamp = time();
			// Genera un hash aleatorio para el mail de verificacion de cambio de contraseña (40 char string)
			$user_password_reset_hash = sha1(uniqid(mt_rand(), true));
			// Coge toda la info del usuario
			$result_row = $this->getDatosUsuario($user_name);
			// si el usuario existe
			if (isset($result_row->user_id)) {
				// Query BD:
				$query_update = $this->bd_conexion->prepare('UPDATE users SET user_password_reset_hash = :user_password_reset_hash,
				user_password_reset_timestamp = :user_password_reset_timestamp
				WHERE user_name = :user_name');
				$query_update->bindValue(':user_password_reset_hash', $user_password_reset_hash, PDO::PARAM_STR);
				$query_update->bindValue(':user_password_reset_timestamp', $temporary_timestamp, PDO::PARAM_INT);
				$query_update->bindValue(':user_name', $user_name, PDO::PARAM_STR);
				$query_update->execute();
				// comprueba si se ha cambiado correctamente una fila
				if ($query_update->rowCount() == 1) {
					// envia un mail al usuario con el enlace
					$this->enviarMailResetPass($user_name, $result_row->user_email, $user_password_reset_hash);
					return true;
				} else {
					$this->errores[] = MENSAJE_BD_ERROR;
				}
			} else {
				$this->errores[] = MENSAJE_USUARIO_NO_EXISTE;
			}
		}
		// return false (este metodo solo devuelve true cuandola entrada a la BD ha sido correcta)
		return false;
	}
	/**
	* envia el mail de reset de la contraseña
	*/
	public function enviarMailResetPass($user_name, $user_email, $user_password_reset_hash){
		$mail = new PHPMailer;
		// usa SMTP o email()
		if (EMAIL_USA_SMTP) {
			// Establecer que se use SMTP
			$mail->IsSMTP();
			// Habilita la autentificacion SMTP
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
			$mail->From = EMAIL_PASSRESET_FROM;
			$mail->FromName = EMAIL_PASSRESET_NOMBRE;
			$mail->AddAddress($user_email);
			$mail->Subject = EMAIL_PASSRESET_ASUNTO;
			$link = EMAIL_PASSRESET_URL.'?user_name='.urlencode($user_name).'&verification_code='.urlencode($user_password_reset_hash);
			$mail->Body = EMAIL_PASSRESET_CONTENIDO . ' ' . $link;
			if(!$mail->Send()) {
				$this->errores[] = MENSAJE_PASS_RESET_MAIL_ERROR . $mail->ErrorInfo;
				return false;
			} else {
				$this->mensajes[] = MENSAJE_PASS_RESET_MAIL_ENVIADO;
				return true;
			}
	}
	/**
	* Comprueba si el mail de verificacion es valido
	*/
	public function comprobarCodMailVerificacionValido($user_name, $verification_code){
		$user_name = trim($user_name);
		if (empty($user_name) || empty($verification_code)) {
			$this->errores[] = MENSAJE_PARAMETRO_VACIO_EN_ENLACE;
		} else {
			// toda la info del usuario
			$result_row = $this->getDatosUsuario($user_name);
			// si el usuario existe y tiene el mismo hash en la BD
			if (isset($result_row->user_id) && $result_row->user_password_reset_hash == $verification_code) {
			$timestamp_one_hour_ago = time() - 3600; // 3600seg = 1h
				if ($result_row->user_password_reset_timestamp > $timestamp_one_hour_ago) {
					$this->password_reset_link_ok= true;
				} else {
					$this->errores[] = MENSAJE_ENLACE_CADUCADO;
				}
			} else {
				$this->errores[] = MENSAJE_USUARIO_NO_EXISTE;
			}
		}
	}
	/**
	* Comprueba y escribe nueva constraseña
	*/
	public function editNuevaPass($user_name, $user_password_reset_hash, $user_password_new, $user_password_repeat){
		$user_name = trim($user_name);
		if (empty($user_name) || empty($user_password_reset_hash) || empty($user_password_new) || empty($user_password_repeat)) {
			$this->errores[] = MENSAJE_PASS_VACIO;
			// si repite la contraseña es diferente a la contraseña
		} else if ($user_password_new !== $user_password_repeat) {
			$this->errores[] = MENSAJE_PASS_CONFIRMAR_ERROR;
		// contraseña minimo 6 caracteres
		} else if (strlen($user_password_new) < 6) {
			$this->errores[] = MENSAJE_PASS_MUY_CORTA;
		// si la conexion ya esta abierta
		} else if ($this->conexionBD()) {
			$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
			$user_password_hash = password_hash($user_password_new, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
			// escribe el nuevo hash del usuario en la BD
			$query_update = $this->bd_conexion->prepare('UPDATE users SET user_password_hash = :user_password_hash,
			user_password_reset_hash = NULL, user_password_reset_timestamp = NULL
			WHERE user_name = :user_name AND user_password_reset_hash = :user_password_reset_hash');
			$query_update->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
			$query_update->bindValue(':user_password_reset_hash', $user_password_reset_hash, PDO::PARAM_STR);
			$query_update->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$query_update->execute();
			if ($query_update->rowCount() == 1) {
				$this->password_reset_ok = true;
				$this->mensajes[] = MENSAJE_PASS_CAMBIO_OK;
			} else {
				$this->errores[] = MENSAJE_PASS_CAMBIO_ERROR;
			}
		}
	}
	/**
	* Coge el estado correcto del enlace de contraseña reset.
	* @return boolean
	*/
	public function passResetLinkOk(){
		return $this->password_reset_link_ok;
	}
	/**
	* Devuelve el estado del reset de contraseña.
	* @return boolean
	*/
	public function passwordResetOk(){
		return $this->password_reset_ok;
	}
	/**
	* Devuelve el nombre de usuario
	* @return string nombre de usuario
	*/
	public function getUsername(){
		return $this->user_name;
	}
	/**
	* Devuelve la URL de la imagen en Gravatar para un mail dado.
	* La URL devuelve siempre un .jpg
	* @see http://de.gravatar.com/site/implement/images/
	*
	* @param string $email Direccion email
	* @param string $s Tamaño en pixels, por defecto 50px [ 1 - 2048 ]
	* @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	* @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	* @param array $atts Optional, additional key/value attributes to include in the IMG tag
	* @source http://gravatar.com/site/implement/images/php/
	*/
	

	public function getImagenGravatarUrl($email, $s = 80){
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5(strtolower(trim($email )));
		$url .= "?s=$s";
		$this -> user_gravatar_imagen_url = $url;
		$url = '<img src="' . $url . '" />';
		$this -> user_gravatar_imagen_tag = $url;
	}
}