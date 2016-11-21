INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES (0, 'proffa.fiksunen@helsinki.fi', 'asdfgasdfsadfasdf', 'suolaa', false);
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES (1, 'oppilas.hononen@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia', false);
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES (2, 'hallintokaytava@helsinki.fi', 'afdssdfgasdfsadfasdf', 'suoleja', true);
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES (3, 'opettaja.tahtinen@helsinki.fi', 'afdssdfgasdfdsfsadfasdf', 'NaCl', false);
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES (4, 'oppilas.hooponen@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia', false);
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES (5, 'oppilas.hupsunen@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia', false);
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES (6, 'oppilas.homelo@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia', false);

INSERT INTO Kurssi (ID, kurssikoodi, nimi,  kotisivu, alkamispaiva, paattymispaiva) VALUES (0, 123456, 'Tähtitieteen perusteet', NULL, '2016-10-31', '2016-12-21');
INSERT INTO Kurssi (ID, kurssikoodi, nimi, kotisivu, alkamispaiva, paattymispaiva) VALUES (1, 456789, 'Fysiikan matemaattiset menetelmät Ia', 'http://wiki.helsinki.fi/pages/viewpage.action?pageId=202023686', '2016-09-06', '2016-10-21');
INSERT INTO Kurssi (ID, kurssikoodi, nimi, kotisivu, alkamispaiva, paattymispaiva) VALUES (2, 715517, 'Aineopintojen harjoitustyö: Tietokantasovellus (periodi II)', 'https://www.cs.helsinki.fi/courses/582203/2016/s/a/2', '2016-10-31', '2016-12-12');
INSERT INTO Kurssi (ID, kurssikoodi, nimi, kotisivu, alkamispaiva, paattymispaiva) VALUES (3, 258369, 'Höpöhöpötieteen perusteet', 'https://www.google.fi', '2016-10-31', '2016-12-21');

INSERT INTO KurssinOpettaja (henkiloID, kurssiID) VALUES (0, 2);
INSERT INTO KurssinOpettaja (henkiloID, kurssiID) VALUES (3, 0);
INSERT INTO KurssinOpettaja (henkiloID, kurssiID) VALUES (3, 1);

INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (1, 0);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (1, 1);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (4, 0);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (4, 2);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (4, 3);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (5, 2);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (6, 0);

INSERT INTO Tila (ID, nimi) VALUES (0, 'luonnos');
INSERT INTO Tila (ID, nimi) VALUES (1, 'käynnissä');
INSERT INTO Tila (ID, nimi) VALUES (2, 'päättynyt');

INSERT INTO Kysely (ID, KurssiID, status) VALUES (0, 0, 1);
INSERT INTO Kysely (ID, KurssiID, status) VALUES (1, 1, 2);
INSERT INTO Kysely (ID, KurssiID, status) VALUES (2, 2, 0);
INSERT INTO Kysely (ID, KurssiID, status) VALUES (3, 3, 1);

INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (0, 0, 'Anna kokonaisarvosana havaintoexculle');
INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (1, 0, 'Sain riittävästi tukea laskareissa (1=täysin eri mieltä, 3=ei samaa eikä eri mieltä, 5=täysin samaa mieltä)');
INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (2, 0, 'Anna kokonaisarvosana kurssille');
INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (3, 0, 'Anna kokonaisarvosana laskareille');

INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (4, 1, 'Sain riittävästi tukea laskareissa (1=täysin eri mieltä, 3=ei samaa eikä eri mieltä, 5=täysin samaa mieltä)');
INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (5, 1, 'Anna kokonaisarvosana kurssille');
INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (6, 1, 'Anna kokonaisarvosana laskareille');

INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (7, 2, 'Harjoitustöiden vaikeustaso oli sopiva (1=täysin eri mieltä, 3=ei samaa eikä eri mieltä, 5=täysin samaa mieltä)');
INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (8, 2, 'Anna kokonaisarvosana kurssille');
INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (9, 2, 'Anna kokonaisarvosana laskareille');

INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (10, 3, 'Kurssi oli riittävän huuruinen (1=täysin eri mieltä, 3=ei samaa eikä eri mieltä, 5=täysin samaa mieltä)');
INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (11, 3, 'Sain riittävästi tukea laskareissa (1=täysin eri mieltä, 3=ei samaa eikä eri mieltä, 5=täysin samaa mieltä)');
INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (12, 3, 'Anna kokonaisarvosana kurssille');
INSERT INTO Kysymys (ID, kyselyID, teksti) VALUES (13, 3, 'Anna kokonaisarvosana laskareille');