andmebaasi v‰‰rtused asuvad failis: application\config\database.php
ja seal 'hostname', 'username', 'password', 'database'

praeguse lahenduse andmebaas
-luua suvalise nimega andmebaas ja panna kirja database.php
-teha tabel sql k‰suga

DROP TABLE IF EXISTS `retseptid`;
CREATE TABLE IF NOT EXISTS `retseptid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_title` char(50) NOT NULL,
  `_imgpath` char(50) DEFAULT NULL,
  `_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

