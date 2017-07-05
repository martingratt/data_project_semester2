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
    	Kategorie VARCHAR(50),
    	Preis DECIMAL(4,2),
    	PRIMARY KEY (Kategorie)
    	);

CREATE TABLE Tickets(
	TicketID INT(10) NOT NULL auto_increment,
    	SpieltagID INT,
    	Kategorie VARCHAR(50),
    	Username VARCHAR(50),
    	PRIMARY KEY (TicketID),
    	FOREIGN KEY (SpieltagID) REFERENCES Spieltage (SpieltagID),
    	FOREIGN KEY (Kategorie) REFERENCES Kategorie(Kategorie),
    	FOREIGN KEY (Username) REFERENCES Personen(Username)
    	);
    
    
INSERT INTO Ort(PLZ, Ort) VALUES
	('A-9961', 'Hopfgarten'),
   	('A-6322', 'Kirchbichl'),
	('A-6330', 'Kufstein'),
	('D-83022', 'Rosenheim'),
	('I-39023', 'Laas'),
	('A-6020', 'Innsbruck'),
    	('D-80331', 'Muenchen'),

    	('A-6300', 'Woergl'),

    	('A-9900', 'Lienz'),

    	('I-10057', 'Turin');

INSERT INTO Personen(Username, Nachname, Vorname, Geschlecht, PLZ, Strasse, Passwort) VALUES
	('pgsaller', 'Gsaller', 'Philipp', 'm', 'A-9961', 'Plon 36', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'), /*asdf*/
    	('mgratt', 'Gratt', 'Martin', 'm', 'A-6322', 'Hauptstraße 1', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'),
	('rspechtenhauser', 'Spechtenhauser', 'Robin', 'm', 'A-6330', 'Schulweg 13', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'),
	('portner', 'Ortner', 'Peter', 'm', 'D-83022', 'Odeonsplatz 45', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'),
	('ggattuso', 'Gattuso', 'Gennaro', 'm', 'I-39023', 'Dorf 20', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'),
	('hhauser', 'Hauser', 'Hannes', 'm', 'A-6020', 'Theresienstraße 55', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b');
    
INSERT INTO Spieltage(SpieltagID, Datum, Uhrzeit, Gegner) VALUES
	(1,'2017-06-08', '20:00', 'Wacker Innsbruck'),
   	(2,'2017-06-17', '15:30', 'WSG Wattens'),
	(3,'2017-06-21', '18:30', 'FC Kufstein'),
	(4,'2017-06-24', '20:00', 'FC Wörgl'),
	(5,'2017-07-30', '18:30', 'Austria Salzburg'),
	(6,'2017-08-03', '15:30', 'SC Altach')
	(7,'2017-08-11', '20:00', 'Juventus Turin'),
	(8,'2017-08-15', '20:45', 'Real Madrid'),
	(9,'2017-08-22', '18:30', 'Chelsea London'),
	(10,'2017-08-29', '21:30', 'Manchester United');
	
 
INSERT INTO Kategorie(Kategorie, Preis) VALUES
	('Suedkurve', 25.00),
	('Osttribuene', 30.00),
	('Westtribuene', 30.00),
	('Nordkurve', 20.00),
	('VIP', 60.00);

INSERT INTO Tickets(SpieltagID, Kategorie, Username) VALUES
	(1,'Suedkurve', 'pgsaller'),
    	(1,'Osttribuene', 'mgratt'),
	(1,'Osttribuene', 'rspechtenhauser'),
	(2,'VIP', 'portner'),
	(3,'Suedkurve', 'ggattuso'),
	(4,'Nordkurve', 'hhauser');
    
    
CREATE VIEW Reservierungen AS
SELECT TicketID, t.SpieltagID AS Spieltag, s.Datum AS Datum, s.Uhrzeit AS Uhrzeit, s.Gegner AS Gegner, t.Kategorie AS Kategorie, k.Preis AS Preis, Username
FROM tickets t
JOIN kategorie k
ON t.Kategorie = k.Kategorie
JOIN spieltage s
ON t.SpieltagID = s.SpieltagID;


CREATE VIEW Gesamtpreis AS
SELECT SUM(Preis) AS Gesamtpreis, Username
FROM Reservierungen;
