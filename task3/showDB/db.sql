CREATE TABLE application (
  application_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(128) NOT NULL DEFAULT '',
  email varchar(128) NOT NULL DEFAULT '',
  year int(10) NOT NULL DEFAULT 0,
  sex varchar(10) NOT NULL DEFAULT '',
  hand varchar(10) NOT NULL DEFAULT '',
  biography varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (application_id)
);

CREATE TABLE abilities (
  abilities_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  application_id int(10) NOT NULL DEFAULT 0,
  superpower_id int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (abilities_id)
);