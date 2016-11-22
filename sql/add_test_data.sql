INSERT INTO Kayttaja (sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES ('proffa.fiksunen@helsinki.fi', 'asdfgasdfsadfasdf', 'suolaa', false);
INSERT INTO Kayttaja (sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES ('oppilas.hononen@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia', false);
INSERT INTO Kayttaja (sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES ('hallintokaytava@helsinki.fi', 'afdssdfgasdfsadfasdf', 'suoleja', true);
INSERT INTO Kayttaja (sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES ('opettaja.tahtinen@helsinki.fi', 'afdssdfgasdfdsfsadfasdf', 'NaCl', false);
INSERT INTO Kayttaja (sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES ('oppilas.hooponen@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia', false);
INSERT INTO Kayttaja (sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES ('oppilas.hupsunen@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia', false);
INSERT INTO Kayttaja (sahkoposti, salasanaHash, suola, hallintohenkilo) VALUES ('oppilas.homelo@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia', false);

INSERT INTO Kurssi (kurssikoodi, nimi, kotisivu, alkamispaiva, paattymispaiva) VALUES (123456, 'Tähtitieteen perusteet', NULL, '2016-10-31', '2016-12-21');
INSERT INTO Kurssi (kurssikoodi, nimi, kotisivu, alkamispaiva, paattymispaiva) VALUES (456789, 'Fysiikan matemaattiset menetelmät Ia', 'http://wiki.helsinki.fi/pages/viewpage.action?pageId=202023686', '2016-09-06', '2016-10-21');
INSERT INTO Kurssi (kurssikoodi, nimi, kotisivu, alkamispaiva, paattymispaiva) VALUES (715517, 'Aineopintojen harjoitustyö: Tietokantasovellus (periodi II)', 'https://www.cs.helsinki.fi/courses/582203/2016/s/a/2', '2016-10-31', '2016-12-12');
INSERT INTO Kurssi (kurssikoodi, nimi, kotisivu, alkamispaiva, paattymispaiva) VALUES (258369, 'Höpöhöpötieteen perusteet', 'https://www.google.fi', '2016-10-31', '2016-12-21');
INSERT INTO Kurssi (kurssikoodi, nimi, kotisivu, alkamispaiva, paattymispaiva) VALUES (159753, 'Taivaanmekaniikka', NULL, '2016-10-31', '2016-12-21');


INSERT INTO KurssinOpettaja (henkiloID, kurssiID) VALUES (1, 3);
INSERT INTO KurssinOpettaja (henkiloID, kurssiID) VALUES (4, 1);
INSERT INTO KurssinOpettaja (henkiloID, kurssiID) VALUES (4, 2);
INSERT INTO KurssinOpettaja (henkiloID, kurssiID) VALUES (4, 5);

INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (2, 1);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (2, 2);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (5, 1);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (5, 3);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (5, 4);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (6, 3);
INSERT INTO KurssinOsallistuja (henkiloID, kurssiID) VALUES (7, 1);

INSERT INTO Tila (nimi) VALUES ('luonnos');
INSERT INTO Tila (nimi) VALUES ('käynnissä');
INSERT INTO Tila (nimi) VALUES ('päättynyt');

INSERT INTO Kysely (KurssiID, status) VALUES (1, 2);
INSERT INTO Kysely (KurssiID, status) VALUES (2, 3);
INSERT INTO Kysely (KurssiID, status) VALUES (3, 1);
INSERT INTO Kysely (KurssiID, status) VALUES (4, 2);

INSERT INTO Kysymys (kyselyID, teksti) VALUES (1, 'Anna kokonaisarvosana havaintoexculle');
INSERT INTO Kysymys (kyselyID, teksti) VALUES (1, 'Sain riittävästi tukea laskareissa (1=täysin eri mieltä, 3=ei samaa eikä eri mieltä, 5=täysin samaa mieltä)');
INSERT INTO Kysymys (kyselyID, teksti) VALUES (1, 'Anna kokonaisarvosana kurssille');
INSERT INTO Kysymys (kyselyID, teksti) VALUES (1, 'Anna kokonaisarvosana laskareille');

INSERT INTO Kysymys (kyselyID, teksti) VALUES (2, 'Sain riittävästi tukea laskareissa (1=täysin eri mieltä, 3=ei samaa eikä eri mieltä, 5=täysin samaa mieltä)');
INSERT INTO Kysymys (kyselyID, teksti) VALUES (2, 'Anna kokonaisarvosana kurssille');
INSERT INTO Kysymys (kyselyID, teksti) VALUES (2, 'Anna kokonaisarvosana laskareille');

INSERT INTO Kysymys (kyselyID, teksti) VALUES (3, 'Harjoitustöiden vaikeustaso oli sopiva (1=täysin eri mieltä, 3=ei samaa eikä eri mieltä, 5=täysin samaa mieltä)');
INSERT INTO Kysymys (kyselyID, teksti) VALUES (3, 'Anna kokonaisarvosana kurssille');
INSERT INTO Kysymys (kyselyID, teksti) VALUES (3, 'Anna kokonaisarvosana laskareille');

INSERT INTO Kysymys (kyselyID, teksti) VALUES (4, 'Anna kokonaisarvosana havaintoexculle'); 3, 'Kurssi oli riittävän huuruinen (1=täysin eri mieltä, 3=ei samaa eikä eri mieltä, 5=täysin samaa mieltä)');
INSERT INTO Kysymys (kyselyID, teksti) VALUES (4, 'Sain riittävästi tukea laskareissa (1=täysin eri mieltä, 3=ei samaa eikä eri mieltä, 5=täysin samaa mieltä)');
INSERT INTO Kysymys (kyselyID, teksti) VALUES (4, 'Anna kokonaisarvosana kurssille');
INSERT INTO Kysymys (kyselyID, teksti) VALUES (4, 'Anna kokonaisarvosana laskareille');

INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (2, 1, 5);
INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (2, 2, 3);
INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (2, 3, 4);
INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (2, 4, 3);

INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (2, 5, 4);
INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (2, 6, 3);
INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (2, 7, 4);

INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (5, 1, 5);
INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (5, 2, 4);
INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (5, 3, 3);
INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (5, 4, 3);