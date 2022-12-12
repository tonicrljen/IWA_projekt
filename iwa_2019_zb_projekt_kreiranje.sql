-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
DROP USER IF EXISTS `iwa_2019`@`localhost`;
DROP USER IF EXISTS `iwa_2019`;
DROP SCHEMA IF EXISTS `iwa_2019_zb_projekt`;
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `iwa_2019_zb_projekt` DEFAULT CHARACTER SET utf8 ;
USE `iwa_2019_zb_projekt` ;

CREATE USER 'iwa_2019'@'localhost' IDENTIFIED BY 'foi2019';

GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `iwa_2019_zb_projekt`.* TO 'iwa_2019'@'localhost';

-- -----------------------------------------------------
-- Table `iwa_2019_zb_projekt`.`tip_korisnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2019_zb_projekt`.`tip_korisnika` (
  `tip_id` INT(10) NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`tip_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2019_zb_projekt`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2019_zb_projekt`.`korisnik` (
  `korisnik_id` INT(10) NOT NULL AUTO_INCREMENT,
  `tip_id` INT(10) NOT NULL,
  `korisnicko_ime` VARCHAR(50) NOT NULL,
  `lozinka` VARCHAR(50) NOT NULL,
  `ime` VARCHAR(50) NULL,
  `prezime` VARCHAR(50) NULL,
  `email` VARCHAR(50) NULL,
  `slika` TEXT NULL,
  PRIMARY KEY (`korisnik_id`),
  INDEX `fk_korisnik_tip_korisnika_idx` (`tip_id` ASC),
  CONSTRAINT `fk_korisnik_tip_korisnika`
    FOREIGN KEY (`tip_id`)
    REFERENCES `iwa_2019_zb_projekt`.`tip_korisnika` (`tip_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2019_zb_projekt`.`kategorija`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2019_zb_projekt`.`kategorija` (
  `kategorija_id` INT(10) NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(50) NOT NULL,
  `opis` TEXT NULL,
  `obavezna` TINYINT(1) NOT NULL,
  PRIMARY KEY (`kategorija_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2019_zb_projekt`.`projekt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2019_zb_projekt`.`projekt` (
  `projekt_id` INT(10) NOT NULL AUTO_INCREMENT,
  `korisnik_id` INT(10) NOT NULL,
  `moderator_id` INT(10) NOT NULL,
  `datum_vrijeme_kreiranja` DATETIME NOT NULL,
  `naziv` VARCHAR(45) NULL,
  `opis` TEXT NULL,
  `zakljucan` TINYINT(1) NOT NULL,
  INDEX `fk_tvrtka_has_korisnik_korisnik1_idx` (`korisnik_id` ASC),
  PRIMARY KEY (`projekt_id`),
  INDEX `fk_projekt_korisnik1_idx` (`moderator_id` ASC),
  CONSTRAINT `fk_tvrtka_has_korisnik_korisnik1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `iwa_2019_zb_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_korisnik1`
    FOREIGN KEY (`moderator_id`)
    REFERENCES `iwa_2019_zb_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2019_zb_projekt`.`stavke_projekta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2019_zb_projekt`.`stavke_projekta` (
  `projekt_id` INT(10) NOT NULL,
  `kategorija_id` INT(10) NOT NULL,
  `opis` TEXT NOT NULL,
  `slika` TEXT NOT NULL,
  `video` TEXT NULL,
  PRIMARY KEY (`projekt_id`, `kategorija_id`),
  INDEX `fk_projekt_ima_kategoriju_kategorija1_idx` (`kategorija_id` ASC),
  INDEX `fk_projekt_ima_kategoriju_projekt1_idx` (`projekt_id` ASC),
  CONSTRAINT `fk_projekt_ima_kategoriju_kategorija1`
    FOREIGN KEY (`kategorija_id`)
    REFERENCES `iwa_2019_zb_projekt`.`kategorija` (`kategorija_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_ima_kategoriju_projekt1`
    FOREIGN KEY (`projekt_id`)
    REFERENCES `iwa_2019_zb_projekt`.`projekt` (`projekt_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
USE `iwa_2019_zb_projekt` ;



INSERT INTO `tip_korisnika` (`tip_id`, `naziv`) VALUES
(0, 'administrator'),
(1, 'voditelj'),
(2, 'korisnik');


INSERT INTO `korisnik` (`korisnik_id`, `tip_id`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `email`, `slika`) VALUES
(1, 0, 'admin', 'foi', 'Administrator', 'Admin', 'admin@foi.hr', 'korisnici/admin.jpg'),
(2, 1, 'voditelj', '123456', 'voditelj', 'Vodi', 'voditelj@foi.hr', 'korisnici/admin.jpg'),
(3, 2, 'pkos', '123456', 'Pero', 'Kos', 'pkos@fff.hr', 'korisnici/pkos.jpg'),
(4, 2, 'vzec', '123456', 'Vladimir', 'Zec', 'vzec@fff.hr', 'korisnici/vzec.jpg'),
(5, 2, 'qtarantino', '123456', 'Quentin', 'Tarantino', 'qtarantino@foi.hr', 'korisnici/qtarantino.jpg'),
(6, 2, 'mbellucci', '123456', 'Monica', 'Bellucci', 'mbellucci@foi.hr', 'korisnici/mbellucci.jpg'),
(7, 2, 'vmortensen', '123456', 'Viggo', 'Mortensen', 'vmortensen@foi.hr', 'korisnici/vmortensen.jpg'),
(8, 2, 'jgarner', '123456', 'Jennifer', 'Garner', 'jgarner@foi.hr', 'korisnici/jgarner.jpg'),
(9, 2, 'nportman', '123456', 'Natalie', 'Portman', 'nportman@foi.hr', 'korisnici/nportman.jpg'),
(10, 2, 'dradcliffe', '123456', 'Daniel', 'Radcliffe', 'dradcliffe@foi.hr', 'korisnici/dradcliffe.jpg'),
(11, 2, 'hberry', '123456', 'Halle', 'Berry', 'hberry@foi.hr', 'korisnici/hberry.jpg'),
(12, 2, 'vdiesel', '123456', 'Vin', 'Diesel', 'vdiesel@foi.hr', 'korisnici/vdiesel.jpg'),
(13, 2, 'ecuthbert', '123456', 'Elisha', 'Cuthbert', 'ecuthbert@foi.hr', 'korisnici/ecuthbert.jpg'),
(14, 2, 'janiston', '123456', 'Jennifer', 'Aniston', 'janiston@foi.hr', 'korisnici/janiston.jpg'),
(15, 2, 'ctheron', '123456', 'Charlize', 'Theron', 'ctheron@foi.hr', 'korisnici/ctheron.jpg'),
(16, 2, 'nkidman', '123456', 'Nicole', 'Kidman', 'nkidman@foi.hr', 'korisnici/nkidman.jpg'),
(17, 2, 'ewatson', '123456', 'Emma', 'Watson', 'ewatson@foi.hr', 'korisnici/ewatson.jpg'),
(18, 1, 'kdunst', '123456', 'Kirsten', 'Dunst', 'kdunst@foi.hr', 'korisnici/kdunst.jpg'),
(19, 2, 'sjohansson', '123456', 'Scarlett', 'Johansson', 'sjohansson@foi.hr', 'korisnici/sjohansson.jpg'),
(20, 2, 'philton', '123456', 'Paris', 'Hilton', 'philton@foi.hr', 'korisnici/philton.jpg'),
(21, 2, 'kbeckinsale', '123456', 'Kate', 'Beckinsale', 'kbeckinsale@foi.hr', 'korisnici/kbeckinsale.jpg'),
(22, 2, 'tcruise', '123456', 'Tom', 'Cruise', 'tcruise@foi.hr', 'korisnici/tcruise.jpg'),
(23, 2, 'hduff', '123456', 'Hilary', 'Duff', 'hduff@foi.hr', 'korisnici/hduff.jpg'),
(24, 2, 'ajolie', '123456', 'Angelina', 'Jolie', 'ajolie@foi.hr', 'korisnici/ajolie.jpg'),
(25, 2, 'kknightley', '123456', 'Keira', 'Knightley', 'kknightley@foi.hr', 'korisnici/kknightley.jpg'),
(26, 2, 'obloom', '123456', 'Orlando', 'Bloom', 'obloom@foi.hr', 'korisnici/obloom.jpg'),
(27, 2, 'llohan', '123456', 'Lindsay', 'Lohan', 'llohan@foi.hr', 'korisnici/llohan.jpg'),
(28, 2, 'jdepp', '123456', 'Johnny', 'Depp', 'jdepp@foi.hr', 'korisnici/jdepp.jpg'),
(29, 2, 'kreeves', '123456', 'Keanu', 'Reeves', 'kreeves@foi.hr', 'korisnici/kreeves.jpg'),
(30, 1, 'thanks', '123456', 'Tom', 'Hanks', 'thanks@foi.hr', 'korisnici/thanks.jpg'),
(31, 2, 'elongoria', '123456', 'Eva', 'Longoria', 'elongoria@foi.hr', 'korisnici/elongoria.jpg'),
(32, 2, 'rde', '123456', 'Robert', 'De', 'rde@foi.hr', 'korisnici/rde.jpg'),
(33, 2, 'jheder', '123456', 'Jon', 'Heder', 'jheder@foi.hr', 'korisnici/jheder.jpg'),
(34, 2, 'rmcadams', '123456', 'Rachel', 'McAdams', 'rmcadams@foi.hr', 'korisnici/rmcadams.jpg'),
(35, 2, 'cbale', '123456', 'Christian', 'Bale', 'cbale@foi.hr', 'korisnici/cbale.jpg'),
(36, 1, 'jalba', '123456', 'Jessica', 'Alba', 'jalba@foi.hr', 'korisnici/jalba.jpg'),
(37, 2, 'bpitt', '123456', 'Brad', 'Pitt', 'bpitt@foi.hr', 'korisnici/bpitt.jpg'),
(43, 2, 'apacino', '123456', 'Al', 'Pacino', 'apacino@foi.hr', 'korisnici/apacino.jpg'),
(44, 2, 'wsmith', '123456', 'Will', 'Smith', 'wsmith@foi.hr', 'korisnici/wsmith.jpg'),
(45, 2, 'ncage', '123456', 'Nicolas', 'Cage', 'ncage@foi.hr', 'korisnici/ncage.jpg'),
(46, 2, 'vanne', '123456', 'Vanessa', 'Anne', 'vanne@foi.hr', 'korisnici/vanne.jpg'),
(47, 2, 'kheigl', '123456', 'Katherine', 'Heigl', 'kheigl@foi.hr', 'korisnici/kheigl.jpg'),
(48, 2, 'gbutler', '123456', 'Gerard', 'Butler', 'gbutler@foi.hr', 'korisnici/gbutler.jpg'),
(49, 2, 'jbiel', '123456', 'Jessica', 'Biel', 'jbiel@foi.hr', 'korisnici/jbiel.jpg'),
(50, 2, 'ldicaprio', '123456', 'Leonardo', 'DiCaprio', 'ldicaprio@foi.hr', 'korisnici/ldicaprio.jpg'),
(51, 2, 'mdamon', '123456', 'Matt', 'Damon', 'mdamon@foi.hr', 'korisnici/mdamon.jpg'),
(52, 2, 'hpanettiere', '123456', 'Hayden', 'Panettiere', 'hpanettiere@foi.hr', 'korisnici/hpanettiere.jpg'),
(53, 2, 'rreynolds', '123456', 'Ryan', 'Reynolds', 'rreynolds@foi.hr', 'korisnici/rreynolds.jpg'),
(54, 2, 'jstatham', '123456', 'Jason', 'Statham', 'jstatham@foi.hr', 'korisnici/jstatham.jpg'),
(55, 2, 'enorton', '123456', 'Edward', 'Norton', 'enorton@foi.hr', 'korisnici/enorton.jpg'),
(56, 2, 'mwahlberg', '123456', 'Mark', 'Wahlberg', 'mwahlberg@foi.hr', 'korisnici/mwahlberg.jpg'),
(57, 2, 'jmcavoy', '123456', 'James', 'McAvoy', 'jmcavoy@foi.hr', 'korisnici/jmcavoy.jpg'),
(58, 2, 'epage', '123456', 'Ellen', 'Page', 'epage@foi.hr', 'korisnici/epage.jpg'),
(59, 2, 'mcyrus', '123456', 'Miley', 'Cyrus', 'mcyrus@foi.hr', 'korisnici/mcyrus.jpg'),
(60, 2, 'kstewart', '123456', 'Kristen', 'Stewart', 'kstewart@foi.hr', 'korisnici/kstewart.jpg'),
(61, 2, 'mfox', '123456', 'Megan', 'Fox', 'mfox@foi.hr', 'korisnici/mfox.jpg'),
(62, 2, 'slabeouf', '123456', 'Shia', 'LaBeouf', 'slabeouf@foi.hr', 'korisnici/slabeouf.jpg'),
(63, 2, 'ceastwood', '123456', 'Clint', 'Eastwood', 'ceastwood@foi.hr', 'korisnici/ceastwood.jpg'),
(64, 2, 'srogen', '123456', 'Seth', 'Rogen', 'srogen@foi.hr', 'korisnici/srogen.jpg'),
(65, 2, 'nreed', '123456', 'Nikki', 'Reed', 'nreed@foi.hr', 'korisnici/nreed.jpg'),
(66, 2, 'agreene', '123456', 'Ashley', 'Greene', 'agreene@foi.hr', 'korisnici/agreene.jpg'),
(67, 2, 'zdeschanel', '123456', 'Zooey', 'Deschanel', 'zdeschanel@foi.hr', 'korisnici/zdeschanel.jpg'),
(68, 2, 'dfanning', '123456', 'Dakota', 'Fanning', 'dfanning@foi.hr', 'korisnici/dfanning.jpg'),
(69, 2, 'tlautner', '123456', 'Taylor', 'Lautner', 'tlautner@foi.hr', 'korisnici/tlautner.jpg'),
(70, 2, 'rpattinson', '123456', 'Robert', 'Pattinson', 'rpattinson@foi.hr', 'korisnici/rpattinson.jpg');


INSERT INTO `projekt` (`projekt_id`, `korisnik_id`, `moderator_id`, `naziv`, `opis`, `zakljucan`,`datum_vrijeme_kreiranja`) VALUES
(1, 3, 2, 'Projekt KOS Kuća', 'Projektiranje kuće za obitelj Kos',0,'2019-11-06 15:14:00'),
(2, 3, 2, 'Kućica za psa', 'Projektiranje kućice za psa',1,'2018-10-06 15:14:00'),
(3, 28, 2, 'Projekt Depp Kuća', 'Projektiranje kuće za obitelj Depp',0,'2019-11-06 16:14:00'),
(4, 3, 18, 'Projekt KOS Skladište', 'Projektiranje skladišta za obitelj Kos',0,'2019-10-06 15:14:00');

INSERT INTO `kategorija` (`kategorija_id`, `naziv`, `opis`, `obavezna`) VALUES
(1,'Temelji','Nacrt temelja objekta koji se gradi',1),
(2,'Krovište','Nacrt krovišta objekta koji se gradi',1),
(3,'Struja','Nacrt strujnih instalacija',0),
(4,'Voda','Nacrt instalacija za dovod vode',0),
(5,'Plin','Nacrt instalacija za plin',0),
(6,'Odvod','Nacrt instalacija za odvod',0);


INSERT INTO `stavke_projekta` (`projekt_id`, `kategorija_id`, `opis`,`slika`,`video`) VALUES
(1, 1, 'Temelji će biti problem','http://www.gradbi.si/images/image24387667.png','http://techslides.com/demos/sample-videos/small.mp4'),
(1, 2, 'Krovište za kuću','https://www.digitalmedia.hr/wp-content/uploads/2014/12/korak-3-255x160.jpg','http://www.html5videoplayer.net/videos/toystory.mp4'),
(1, 3, 'Struja nacrt ...','https://www.elteh.net/images/Projekti/Kucno_kabliranje/tlocrt_poslje_1024.png','http://techslides.com/demos/sample-videos/small.mp4'),
(1, 4, 'Voda nacrt ...','https://www.zapadstan.hr/wp-content/uploads/2012/12/paste1.jpg','http://www.html5videoplayer.net/videos/toystory.mp4'),

(2, 1, 'Temelji','http://www.gradbi.si/images/image24387667.png',''),
(2, 2, 'Krovište','https://www.digitalmedia.hr/wp-content/uploads/2014/12/korak-3-255x160.jpg',''),

(3, 1, 'Temelji će biti problem','http://www.gradbi.si/images/image24387667.png','http://techslides.com/demos/sample-videos/small.mp4'),
(3, 2, 'Krovište za kuću','https://www.digitalmedia.hr/wp-content/uploads/2014/12/korak-3-255x160.jpg','http://www.html5videoplayer.net/videos/toystory.mp4'),
(3, 3, 'Struja nacrt ...','https://www.elteh.net/images/Projekti/Kucno_kabliranje/tlocrt_poslje_1024.png','http://techslides.com/demos/sample-videos/small.mp4'),

(4, 3, 'Struja nacrt ...','https://www.elteh.net/images/Projekti/Kucno_kabliranje/tlocrt_poslje_1024.png','http://techslides.com/demos/sample-videos/small.mp4'),
(4, 4, 'Voda nacrt ...','https://www.zapadstan.hr/wp-content/uploads/2012/12/paste1.jpg','http://www.html5videoplayer.net/videos/toystory.mp4');



