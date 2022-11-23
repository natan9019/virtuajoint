CREATE TABLE `users` (
	`idUser` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id autoincremental del usuario',
	`userFName` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Nombre del usuario' COLLATE 'utf8mb4_general_ci',
	`userLName` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Apellido del usuario' COLLATE 'utf8mb4_general_ci',
	`aliasUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Nickname o nombre de usuario dentro del sistema' COLLATE 'utf8mb4_general_ci',
	`paisUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Nacionalidad del usuario' COLLATE 'utf8mb4_general_ci',
	`genderUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Genero del usuario' COLLATE 'utf8mb4_general_ci',
	`emailUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Correo electronico del usuario' COLLATE 'utf8mb4_general_ci',
	`psswdUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Contraseña del usuario' COLLATE 'utf8mb4_general_ci',
	`websiteUser` VARCHAR(50) COMMENT 'Sitio web del usuario (OPCIONAL)' COLLATE 'utf8mb4_general_ci',
	`regDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro de tiempo de la creación del usuario',
	PRIMARY KEY (`idUser`) USING BTREE
)
COMMENT='Usuarios del sistema VirtuaJoint'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=0
;
