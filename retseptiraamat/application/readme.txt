andmebaasi v��rtused asuvad failis: application\config\database.php
ja seal 'hostname', 'username', 'password', 'database'

praeguse lahenduse andmebaas
-luua suvalise nimega andmebaas ja panna kirja database.php
-teha tabelid sql k�suga

DROP TABLE IF EXISTS `retseptid`;
CREATE TABLE IF NOT EXISTS `retseptid` (
  `_recipeID` int(11) NOT NULL AUTO_INCREMENT,
  `_userID` int(11) NOT NULL,
  `_title` char(50) NOT NULL,
  `_titleEng` char(50) DEFAULT NULL,
  `_imgpath` char(50) DEFAULT NULL,
  `_location` char(50) DEFAULT NULL,
  `_text` text NOT NULL,
  `_textEng` text DEFAULT NULL,
  PRIMARY KEY (`_recipeID`),
  FOREIGN KEY (_userID) REFERENCES kasutajad(id)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `toiduained`;
CREATE TABLE IF NOT EXISTS `toiduained` (
	`_ingredientID` int(11) NOT NULL AUTO_INCREMENT,
  	`_recipeID` int(11) NOT NULL,
  	`_ingredient` char(50) NOT NULL,
    `_ingredientEng` char(50) DEFAULT NULL,
  	`_amount` char(50) NOT NULL,
    `_amountEng` char(50) DEFAULT NULL,
  	`_unit` char(50) NOT NULL,
    `_unitEng` char(50) DEFAULT NULL,
  	PRIMARY KEY (`_ingredientID`),
  	FOREIGN KEY (_recipeID) REFERENCES retseptid(_recipeID)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kasutajad`;
CREATE TABLE IF NOT EXISTS `kasutajad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nimi` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `favourites` char(50) DEFAULT NULL,
  `kasutajanimi` char(255) NOT NULL,
   `parool` char(255) NOT NULL,
   `gnum` char(50) DEFAULT NULL,
   `registr_kuup` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `browser` char(50) NOT NULL,
  `visittime` char(50) NOT NULL,
  `page` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;


------------------

DROP PROCEDURE IF EXISTS `p_retseptid`;//
CREATE PROCEDURE `p_retseptid` (in_userID int(11), in_title char(50), in_titleEng char(50), in_imgpath char(50), in_location char(50), in_text text, in_textEng text)
BEGIN
INSERT INTO retseptid (_userID, _title, _titleEng, _imgpath, _location, _text, _textEng)
VALUES (in_userID, in_title, in_titleEng, in_imgpath, in_location, in_text, in_textEng);
END//

DROP PROCEDURE IF EXISTS `p_toiduained`;//
CREATE PROCEDURE `p_toiduained` (in_recipeID int(11), in_ingredient char(50),
in_ingredientEng char(50), in_amount char(50), in_amountEng char(50), in_unit char(50), in_unitEng char(50))
BEGIN
INSERT INTO toiduained (_recipeID, _ingredient, _ingredientEng, _amount, _amountEng, _unit, _unitEng)
VALUES (in_recipeID, in_ingredient, in_ingredientEng, in_amount, in_amountEng, in_unit, in_unitEng);
END//

DROP PROCEDURE IF EXISTS `p_favourites`;//
CREATE PROCEDURE `p_favourites` (in_recipeID int(11), in_fav char(50))
BEGIN
UPDATE kasutajad
SET favourites = in_fav
WHERE id = in_recipeID;
END//

DROP PROCEDURE IF EXISTS `p_gnum`;//
CREATE PROCEDURE `p_gnum` (in_recipeID int(11), in_gnum char(50))
BEGIN
UPDATE kasutajad
SET gnum = in_gnum
WHERE id = in_recipeID;
END//

DROP PROCEDURE IF EXISTS `p_stats`;//
CREATE PROCEDURE `p_stats` (in_browser char(50), in_visittime char(50), in_page char(50))
BEGIN
INSERT INTO stats (browser, visittime, page)
VALUES (in_browser, in_visittime, in_page);
END//

kus eraldaja/delimiter panna //


--------------------

DROP VIEW IF EXISTS `v_retseptid`;
CREATE VIEW `v_retseptid` AS
SELECT _recipeID, _userID, _title, _imgpath, _text FROM retseptid;

DROP VIEW IF EXISTS `v_retseptideng`;
CREATE VIEW `v_retseptidEng` (_recipeID, _userID, _title, _imgpath, _text) AS
SELECT _recipeID, _userID, IFNULL(_titleEng,_title), _imgpath, IFNULL(_textEng,_text) FROM retseptid;

DROP VIEW IF EXISTS `v_kasutajad`;
CREATE VIEW `v_kasutajad` AS
SELECT * FROM kasutajad;

DROP VIEW IF EXISTS `v_favourites`;
CREATE VIEW `v_favourites` AS
SELECT id, favourites FROM kasutajad;

DROP VIEW IF EXISTS `v_location`;
CREATE VIEW `v_location` AS
SELECT _recipeID, _title, _imgpath, _location, _text FROM retseptid WHERE _location IS NOT NULL;

DROP VIEW IF EXISTS `v_locationeng`;
CREATE VIEW `v_locationEng` (_recipeID, _title, _imgpath, _location, _text) AS
SELECT _recipeID, IFNULL(_titleEng,_title), _imgpath, _location, IFNULL(_textEng,_text)
FROM retseptid WHERE _location IS NOT NULL;

DROP VIEW IF EXISTS `v_retseptid_full`;
CREATE VIEW `v_retseptid_full` AS
SELECT retseptid._recipeID, retseptid._title, retseptid._imgpath, retseptid._text, toiduained._ingredient, toiduained._amount, toiduained._unit
FROM retseptid
INNER JOIN toiduained
ON retseptid._recipeID=toiduained._recipeID;

DROP VIEW IF EXISTS `v_retseptideng_full`;
CREATE VIEW `v_retseptidEng_full` (_recipeID, _title, _imgpath, _text, _ingredient, _amount, _unit) AS
SELECT retseptid._recipeID, IFNULL(retseptid._titleEng,retseptid._title), retseptid._imgpath, IFNULL(retseptid._textEng,retseptid._text), 
IFNULL(toiduained._ingredientEng,toiduained._ingredient), IFNULL(toiduained._amountEng,toiduained._amount), IFNULL(toiduained._unitEng,toiduained._unit)
FROM retseptid
INNER JOIN toiduained
ON retseptid._recipeID=toiduained._recipeID;

DROP VIEW IF EXISTS `v_statsbrowser`;
CREATE VIEW `v_statsbrowser` AS
SELECT browser, count(browser) FROM stats GROUP by browser;

DROP VIEW IF EXISTS `v_statstime`;
CREATE VIEW `v_statstime` AS
SELECT visittime, count(visittime) FROM stats GROUP by visittime;

DROP VIEW IF EXISTS `v_statspage`;
CREATE VIEW `v_statspage` AS
SELECT page, count(page) FROM stats GROUP by page;