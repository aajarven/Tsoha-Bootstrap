CREATE TABLE Tila (
  ID SERIAL PRIMARY KEY,
  nimi varchar(150) NOT NULL
);

CREATE TABLE Kayttaja (
  ID SERIAL PRIMARY KEY,
  sahkoposti varchar(256) UNIQUE NOT NULL,
  salasanaHash varchar(256) NOT NULL,
  suola varchar(16) NOT NULL,
  hallintohenkilo boolean NOT NULL
);

CREATE TABLE Kurssi (
  ID SERIAL PRIMARY KEY,
  kurssikoodi INTEGER NOT NULL,
  nimi varchar(150) NOT NULL,
  kotisivu varchar(500),
  alkamispaiva DATE NOT NULL,
  paattymispaiva DATE NOT NULL
);

CREATE TABLE Kysely (
  ID SERIAL PRIMARY KEY,
  kurssiID INTEGER NOT NULL,
  status INTEGER DEFAULT 1,
  FOREIGN KEY (kurssiID) REFERENCES Kurssi (ID),
  FOREIGN KEY (status) REFERENCES Tila (ID)
);

CREATE TABLE Kysymys (
  ID SERIAL PRIMARY KEY,
  kyselyID INTEGER,
  teksti varchar(500) NOT NULL,
  FOREIGN KEY (kyselyID) REFERENCES Kysely (ID) ON DELETE CASCADE
);

CREATE TABLE Vastaus (
  opiskelijaID INTEGER,
  kysymysID INTEGER,
  vastaus INTEGER NOT NULL,
  PRIMARY KEY (opiskelijaID, kysymysID),
  FOREIGN KEY (kysymysID) REFERENCES Kysymys (ID),
  FOREIGN KEY (opiskelijaID) REFERENCES Kayttaja (ID)
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