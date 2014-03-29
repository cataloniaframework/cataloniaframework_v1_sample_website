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

CREATE TABLE `accounts` (
  `account_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_company_name` VARCHAR(50) NOT NULL,
  `account_email_created_with` VARCHAR(100) NOT NULL,
  `account_datetime_created` DATETIME NOT NULL,
  `account_datetime_last_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`account_id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  AUTO_INCREMENT=1;

CREATE TABLE `accounts_users` (
  `accounts_users_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `accounts_id_fk` INT(10) UNSIGNED NOT NULL,
  `accounts_users_email` VARCHAR(50) NOT NULL,
  `accounts_users_password` VARCHAR(50) NOT NULL,
  `accounts_users_name` VARCHAR(50) NOT NULL,
  `accounts_users_surname1` VARCHAR(50) NOT NULL,
  `accounts_users_surname2` VARCHAR(50) NOT NULL,
  `accounts_users_lang` VARCHAR(2) NOT NULL DEFAULT 'en',
  `accounts_users_active` VARCHAR(1) NOT NULL DEFAULT 'T',
  `accounts_users_datetime_created` DATETIME NOT NULL,
  `accounts_users_datetime_last_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`accounts_users_id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  AUTO_INCREMENT=1;
