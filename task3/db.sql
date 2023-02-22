CREATE TABLE application (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(128) NOT NULL DEFAULT '',
  email varchar(128) NOT NULL DEFAULT '',
  year int(10) NOT NULL DEFAULT 0,
  sex varchar(10) NOT NULL DEFAULT '',
  hand varchar(10) NOT NULL DEFAULT '',
  biography varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (id)
);

CREATE TABLE abilities (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  god int(1) NOT NULL DEFAULT 0,
  noclip int(1) NOT NULL DEFAULT 0,
  levitation int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
);
