CREATE TABLE IF NOT EXISTS `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(64) NOT NULL,
  `address` varchar(64) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `email` varchar(64) NOT NULL,
  `person_in_charge` varchar(32) NOT NULL,
  `cust_status` tinyint(4) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delete_time` datetime DEFAULT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
