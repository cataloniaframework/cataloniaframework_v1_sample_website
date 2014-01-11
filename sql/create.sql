USE cataloniafw;

CREATE TABLE `visits` (
	`i_visit_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`s_visit_datetime` VARCHAR(19) NOT NULL,
	`s_visit_ip` VARCHAR(50) NOT NULL,
	`s_referer` VARCHAR(255) NOT NULL,
	`s_visit_user_agent` VARCHAR(255) NOT NULL,
	`s_visit_url_requested` VARCHAR(255) NOT NULL,

	PRIMARY KEY (`i_visit_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE `contact_messages` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(25) NOT NULL,
  `surname` VARCHAR(25) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `message` VARCHAR(5000) NOT NULL,
  `ip_address` VARCHAR(25) NOT NULL,
  `datetime_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE `new_install` (
	`i_new_install_id` INT(10) NOT NULL AUTO_INCREMENT,
	`s_new_install_datetime` VARCHAR(19) NOT NULL,
	`s_new_install_os` VARCHAR(255) NOT NULL,
	`s_new_install_php_version` VARCHAR(255) NOT NULL,
	`s_new_install_framework_version` VARCHAR(255) NOT NULL,
	`s_new_install_user_agent` VARCHAR(255) NOT NULL,
	`s_new_install_client_ip` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`i_new_install_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
