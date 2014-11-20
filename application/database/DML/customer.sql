CREATE TABLE IF NOT EXISTS `customer` (
  cust_id                      INT AUTO_INCREMENT,
  company_name      VARCHAR(64) NOT NULL,
  address                     VARCHAR(64) NOT NULL,
  tel                              VARCHAR(12) NOT NULL,
  email                         VARCHAR(64) NOT NULL,
  person_in_charge  VARCHAR(32) NOT NULL,
  cust_status              TINYINT NOT NULL,
  create_time             DATETIME NOT NULL,
  update_time            TIMESTAMP NOT NULL,
  delete_time             DATETIME,
  PRIMARY KEY (cust_id)
)default character set utf8; 
