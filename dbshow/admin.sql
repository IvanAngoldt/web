CREATE TABLE admins (
  admin_id int(128) unsigned NOT NULL AUTO_INCREMENT,
  login varchar(16) NOT NULL DEFAULT '',
  password varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (admin_id)
);