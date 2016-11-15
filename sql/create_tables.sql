CREATE TABLE Monivalintavaihtoehto (
  kysymysID INTEGER,
  jarjestysluku INTEGER,
  teksti varchar(50) NOT NULL,
  PRIMARY KEY (kysymysID, jarjestysluku)
);

CREATE TABLE Organisaatio (
  organisaatioID INTEGER,
  nimi varchar(150) NOT NULL,
  PRIMARY KEY (organisaatioID)
);

CREATE TABLE KäyttäjäRyhmä (
  ryhmäID INTEGER,
  nimi varchar(150) NOT NULL,
  PRIMARY KEY (ryhmäID)
);

CREATE TABLE Kayttaja (
  ID INTEGER,
  sähköposti varchar(256) NOT NULL,
  salasanaHash varchar(16) NOT NULL,
  suola String NOT NULL,
  PRIMARY KEY (ID)
);

CREATE TABLE Kurssi (
  ID INTEGER,
  nimi String NOT NULL,
  organisaatioID INTEGER NOT NULL,
  kotisivu varchar(500),
  alkamispäivä DATE NOT NULL,
  päättymispäivä DATE NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (organisaatioID) REFERENCES Organisaatio (organisaatioID)
);

CREATE TABLE Kysely (
  ID INTEGER,
  kurssiID INTEGER NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY kurssiID REFERENCES Kurssi (ID)
);

CREATE TABLE Kysymys (
  ID INTEGER,
  organisaatioID INTEGER,
  kyselyID INTEGER,
  tyyppi varchar(30) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY organisaatioID REFERENCES Organisaatio (organisaatioID),
  FOREIGN KEY kyselyID REFERENCES Kysely (ID)
);

CREATE TABLE Monivalintavastaus (
  opiskelijaID INTEGER,
  kysymysID INTEGER,
  jarjestysluku INTEGER,
  PRIMARY KEY (opiskelijaID, kysymysID, jarjestysluku),
  FOREIGN KEY (kysymysID, jarjestysluku) REFERENCES Monivalintavaihtoehto (kysymysID, jarjestysluku),
  FOREIGN KEY (kysymysID) REFERENCES Kysymys (ID),
  FOREIGN KEY (opiskelijaID) REFERENCES Kayttaja (ID)
);

CREATE TABLE AvoinVastaus (
  opiskelijaID INTEGER,
  kysymysID INTEGER,
  vastaus varchar(5000),
  PRIMARY KEY (opiskelijaID, kysymysID),
  FOREIGN KEY (opiskelijaID) REFERENCES Kayttaja (ID),
  FOREIGN KEY (kysymysID) REFERENCES Kysymys (ID)
);

CREATE TABLE RyhmäJäsenyys (
  käyttäjäID INTEGER,
  ryhmäID INTEGER,
  organisaatioID INTEGER,
  PRIMARY KEY (kayttajaID, ryhmaID, organisaatioID),
  FOREIGN KEY (henkiloID) REFERENCES Kayttaja (ID),
  FOREIGN KEY (kurssiID) REFERENCES Kurssi (ID)
);

CREATE TABLE KurssinOsallistuja (
  henkiloID INTEGER,
  kurssiID INTEGER,
  PRIMARY KEY (henkiloID, kurssiID),
  FOREIGN KEY (henkiloID) REFERENCES Kayttaja (ID),
  FOREIGN KEY (kurssiID) REFERENCES Kurssi (ID)
);

CREATE TABLE KurssinOpettaja (
  henkiloID INTEGER,
  kurssiID INTEGER,
  PRIMARY KEY (henkiloID, kurssiID),
  FOREIGN KEY (henkiloID) REFERENCES Kayttaja (ID),
  FOREIGN KEY (kurssiID) REFERENCES Kurssi (ID)
);



