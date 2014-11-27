CREATE TABLE IF NOT EXISTS `export_log` (
  `export_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(64) NOT NULL,
  `use` tinyint NOT NULL,
  `type` tinyint NOT NULL,
  `user_id` int(11) NOT NULL,
  `export_time` datetime NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delete_time` datetime DEFAULT NULL,
  PRIMARY KEY (`export_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
