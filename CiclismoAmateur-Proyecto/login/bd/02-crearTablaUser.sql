CREATE TABLE IF NOT EXISTS `ciclismo`.`users` (
 `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'c�digo �nico para cada usuario, auto incremental',
 `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'nombre de usuario, �nico para cada usuario',
 `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'password de usuario, formato hash',
 `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mail de usuario, �nico',
 `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'estado de activaci�n del usuario',
 `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'string hash del mail de verificaci�n de usuario',
 `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'c�digo de reseteo de la password',
 `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp de la petici�n del reseteo de la password',
 `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'cookie "recu�rdame" de usuario',
 `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'intentos fallido de login',
 `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'timestamp del �ltimo intento fallido de login',
 `user_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
 PRIMARY KEY (`user_id`),
 UNIQUE KEY `user_name` (`user_name`),
 UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
