USE cataloniafw;

CREATE TABLE `visits` (
	`i_visit_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`s_visit_datetime` VARCHAR(19) NOT NULL,
	`s_visit_ip` VARCHAR(50) NOT NULL,
	`s_referer` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`i_visit_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;
