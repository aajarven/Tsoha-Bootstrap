CREATE TABLE Monivalintavaihtoehto (
  kysymysID INTEGER,
  jarjestysluku INTEGER,
  teksti varchar(50) NOT NULL,
  PRIMARY KEY (kysymysID, jarjestysluku)
);

CREATE TABLE Organisaatio (
  organisaatioID SERIAL PRIMARY KEY,
  nimi varchar(150) NOT NULL
);

CREATE TABLE KayttajaRyhma (
  ryhmaID SERIAL PRIMARY KEY,
  nimi varchar(150) NOT NULL
);

CREATE TABLE Tila (
  ID SERIAL PRIMARY KEY,
  nimi varchar(150) NOT NULL
);

CREATE TABLE Kayttaja (
  ID SERIAL PRIMARY KEY,
  sahkoposti varchar(256) NOT NULL,
  salasanaHash varchar(256) NOT NULL,
  suola varchar(16) NOT NULL
);

CREATE TABLE Kurssi (
  ID SERIAL PRIMARY KEY,
  kurssikoodi INTEGER NOT NULL,
  nimi varchar(150) NOT NULL,
  organisaatioID INTEGER NOT NULL,
  kotisivu varchar(500),
  alkamispaiva DATE NOT NULL,
  paattymispaiva DATE NOT NULL,
  FOREIGN KEY (organisaatioID) REFERENCES Organisaatio (organisaatioID)
);

CREATE TABLE Kysely (
  ID SERIAL PRIMARY KEY,
  kurssiID INTEGER NOT NULL,
  status INTEGER NOT NULL,
  FOREIGN KEY (kurssiID) REFERENCES Kurssi (ID),
  FOREIGN KEY (status) REFERENCES Tila (ID)
);

CREATE TABLE Kysymys (
  ID SERIAL PRIMARY KEY,
  organisaatioID INTEGER,
  kyselyID INTEGER,
  tyyppi varchar(30) NOT NULL,
  teksti varchar(500) NOT NULL,
  FOREIGN KEY (organisaatioID) REFERENCES Organisaatio (organisaatioID),
  FOREIGN KEY (kyselyID) REFERENCES Kysely (ID)
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

CREATE TABLE RyhmaJasenyys (
  kayttajaID INTEGER,
  ryhmaID INTEGER,
  organisaatioID INTEGER,
  PRIMARY KEY (kayttajaID, ryhmaID, organisaatioID),
  FOREIGN KEY (kayttajaID) REFERENCES Kayttaja (ID),
  FOREIGN KEY (ryhmaID) REFERENCES KayttajaRyhma (ryhmaID),
  FOREIGN KEY (organisaatioID) REFERENCES Organisaatio (organisaatioID)
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