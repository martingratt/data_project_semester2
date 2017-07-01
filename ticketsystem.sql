DROP DATABASE Ticketsystem;

CREATE DATABASE Ticketsystem;

USE Ticketsystem;

CREATE TABLE Ort(
	PLZ VARCHAR(10),
    Ort VARCHAR(50),
    PRIMARY KEY (PLZ)
    );

CREATE TABLE Personen(
	Username VARCHAR(50),
    Nachname VARCHAR(50),
    Vorname VARCHAR(50),
	Geschlecht VARCHAR(1),
    PLZ VARCHAR(10),
    Strasse VARCHAR(50),
    Passwort VARCHAR(100),
    PRIMARY KEY (Username),
    FOREIGN KEY (PLZ) REFERENCES Ort(PLZ)
    );

CREATE TABLE Spieltage(
	SpieltagID INT,
    Datum DATE,
    Uhrzeit TIME,
    Gegner VARCHAR(50),
    PRIMARY KEY (SpieltagID)
    );
    
CREATE TABLE Kategorie(
	KategorieID INT,
    Bezeichnung VARCHAR(50),
    Preis DECIMAL(4,2),
    PRIMARY KEY (KategorieID)
    );
    
CREATE TABLE Tickets(
	TicketID INT,
    SpieltagID INT,
    KategorieID INT,
    Stadionblock VARCHAR(10),
    Reihe INT,
    Sitzplatz INT,
    Username VARCHAR(50),
    PRIMARY KEY (TicketID),
    FOREIGN KEY (SpieltagID) REFERENCES Spieltage(SpieltagID),
    FOREIGN KEY (KategorieID) REFERENCES Kategorie(KategorieID),
    FOREIGN KEY (Username) REFERENCES Personen(Username)
    );


    
INSERT INTO Ort(PLZ, Ort) VALUES
	('A-9961', 'Hopfgarten'),
    ('A-6322', 'Kirchbichl'),
	('A-6330', 'Kufstein'),
	('D-83022', 'Rosenheim'),
	('I-39023', 'Laas'),
	('A-6020', 'Innsbruck');

INSERT INTO Personen(Username, Nachname, Vorname, Geschlecht, PLZ, Strasse, Passwort) VALUES
	('pgsaller', 'Gsaller', 'Philipp', 'm', 'A-9961', 'Plon 36', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'), /*asdf*/
    ('mgratt', 'Gratt', 'Martin', 'm', 'A-6322', 'Hauptstraße 1', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'),
	('rspechtenhauser', 'Spechtenhauser', 'Robin', 'm', 'A-6330', 'Schulweg 13', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'),
	('portner', 'Ortner', 'Peter', 'm', 'D-83022', 'Odeonsplatz 45', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'),
	('ggattuso', 'Gattuso', 'Gennaro', 'm', 'I-39023', 'Dorf 20', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'),
	('hhauser', 'Hauser', 'Hannes', 'm', 'A-6020', 'Theresienstraße 55', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b');
    
INSERT INTO Spieltage(SpieltagID, Datum, Uhrzeit, Gegner) VALUES
	(1, '2017-06-08', '20:00', 'Wacker Innsbruck'),
    (2, '2017-06-17', '15:30', 'WSG Wattens'),
	(3, '2017-06-21', '18:30', 'FC Kufstein'),
	(4, '2017-06-24', '20:00', 'FC Wörgl'),
	(5, '2017-07-01', '18:30', 'Austria Salzburg'),
	(6, '2017-07-13', '15:30', 'SC Altach');
    
INSERT INTO Kategorie(KategorieID, Bezeichnung, Preis) VALUES
	(1, 'Südkurve', 25.00),
	(2, 'Osttribüne', 30.00),
	(3, 'Westtribüne', 30.00),
	(4, 'Nordkurve', 20.00),
	(5, 'VIP', 60.00);
    
INSERT INTO Tickets(TicketID, SpieltagID, KategorieID, Stadionblock, Reihe, Sitzplatz, Username) VALUES
	(1, 1, 1, 'A', 10, 15, 'pgsaller'),
    (2, 1, 2, 'G', 50, 1, 'mgratt'),
	(3, 1, 2, 'G', 50, 2, 'rspechtenhauser'),
	(4, 2, 5, 'A', 2, 20, 'portner'),
	(5, 3, 1, 'B', 21, 44, 'ggattuso'),
	(6, 5, 4, 'D', 8, 21, 'hhauser');

SELECT s.Datum AS Datum, s.Uhrzeit AS Uhrzeit, s.Gegner AS Auswärtmannschaft, p.KategorieID AS Kategorie
FROM tickets p
Right JOIN spieltage s
ON p.SpieltagID = s.SpieltagID
WHERE Username = 'mgratt';

SELECT p.nickname AS nickname,
                      s.score AS score
                      FROM `user` p
                      LEFT JOIN Scores s
                      ON p.userid = s.userid
                      ORDER BY s.score DESC
                      Limit 15;
    