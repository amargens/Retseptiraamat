andmebaasi v‰‰rtused asuvad failis: application\config\database.php
ja seal 'hostname', 'username', 'password', 'database'

praeguse lahenduse andmebaas
-luua suvalise nimega andmebaas ja panna kirja database.php
-teha tabelid sql k‰suga

DROP TABLE IF EXISTS `retseptid`;
CREATE TABLE IF NOT EXISTS `retseptid` (
  `_recipeID` int(11) NOT NULL AUTO_INCREMENT,
  `_title` char(50) NOT NULL,
  `_imgpath` char(50) DEFAULT NULL,
  `_text` text NOT NULL,
  PRIMARY KEY (`_recipeID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `toiduained`;
CREATE TABLE IF NOT EXISTS `toiduained` (
	`_ingredientID` int(11) NOT NULL AUTO_INCREMENT,
  	`_recipeID` int(11) NOT NULL,
  	`_ingredient` char(50) NOT NULL,
  	`_amount` char(50) DEFAULT NULL,
  	`_unit` char(50) NOT NULL,
  	PRIMARY KEY (`_ingredientID`),
  	FOREIGN KEY (_recipeID) REFERENCES retseptid(_recipeID)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;