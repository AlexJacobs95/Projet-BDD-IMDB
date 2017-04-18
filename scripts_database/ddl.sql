SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
SET @@global.innodb_large_prefix = 1;



-- -----------------------------------------------------
-- Table Personne
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Personne (
  Prenom varchar(128) NOT NULL,
  Nom varchar(128) NOT NULL,
  Genre CHAR(2) NOT NULL,
  PRIMARY KEY (Prenom, Nom))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table Auteur
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Auteur (
  Prenom varchar(128) NOT NULL,
  Nom varchar(128) NOT NULL,
  OID VARCHAR(512) NOT NULL,
  FOREIGN KEY (Prenom, Nom) REFERENCES Personne(Prenom, Nom),
  FOREIGN KEY (OID) REFERENCES Oeuvre(ID))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Directeur
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Directeur (
  Prenom varchar(128) NOT NULL,
  Nom varchar(128) NOT NULL,
  OID VARCHAR(512) NOT NULL,
  FOREIGN KEY (Prenom, Nom) REFERENCES Personne(Prenom, Nom),
  FOREIGN KEY (OID) REFERENCES Oeuvre(ID))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table Acteur
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Acteur (
  Prenom varchar(128) NOT NULL,
  Nom varchar(128) NOT NULL,
  OID VARCHAR(512) NOT NULL,
  Role varchar(128) NOT NULL,
  PRIMARY KEY (Prenom, Nom, OID, Role),
  FOREIGN KEY (Prenom, Nom) REFERENCES Personne(Prenom, Nom),
  FOREIGN KEY (OID) REFERENCES Oeuvre(ID))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table Oeuvre
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Oeuvre (
  ID VARCHAR(512) NOT NULL,
  Titre VARCHAR(256) NOT NULL,
  AnneeSortie INT NOT NULL,
  Note INT,
  PRIMARY KEY (ID))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Film
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Film (
  FilmID VARCHAR(512) NOT NULL,
  PRIMARY KEY (FilmID),
  FOREIGN KEY (FilmID) REFERENCES Oeuvre(ID))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Serie
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Serie (
  SerieID VARCHAR(512) NOT NULL,
  AnneeFin INT,
  PRIMARY KEY (SerieID),
  FOREIGN KEY (SerieID) REFERENCES Oeuvre(ID))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Episode
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Episode (
  EpisodeID VARCHAR(512) NOT NULL,
  TitreS VARCHAR(256),
  NumeroE INT,
  Saison INT,
  DateSortie INT,
  SID VARCHAR(256) NOT NULL,
  PRIMARY KEY (EpisodeID),
  FOREIGN KEY (EpisodeID) REFERENCES Oeuvre(ID),
  FOREIGN KEY (SID) REFERENCES Serie(SerieID))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Pays
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Pays (
  ID VARCHAR(512) NOT NULL,
  Pays VARCHAR(256) NOT NULL,
  PRIMARY KEY (ID, Pays),
  FOREIGN KEY (ID) REFERENCES Oeuvre(ID))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table Genre
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Genre (
  ID VARCHAR(512) NOT NULL,
  Genre VARCHAR(64) NOT NULL,
  PRIMARY KEY (ID, Genre),
  FOREIGN KEY (ID) REFERENCES Oeuvre(ID))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table Langue
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Langue (
  ID VARCHAR(512) NOT NULL,
  Langue VARCHAR(256) NOT NULL,
  PRIMARY KEY (ID, Langue),
  FOREIGN KEY (ID) REFERENCES Oeuvre(ID))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table Administrateur
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Administrateur (
  AdresseMail VARCHAR(256) NOT NULL,
  motDePasse VARCHAR(256) NULL,
  PRIMARY KEY (AdresseMail))
  CHARACTER SET latin1 COLLATE latin1_bin
  ENGINE = InnoDB;




