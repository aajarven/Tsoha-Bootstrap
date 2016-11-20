INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola) VALUES (0, 'proffa.fiksunen@helsinki.fi', 'asdfgasdfsadfasdf', 'suolaa');
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola) VALUES (1, 'oppilas.hononen@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia');
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola) VALUES (2, 'hallintokaytava@helsinki.fi', 'afdssdfgasdfsadfasdf', 'suoleja');
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola) VALUES (3, 'opettaja.tahtinen@helsinki.fi', 'afdssdfgasdfdsfsadfasdf', 'NaCl');
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola) VALUES (4, 'oppilas.hooponen@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia');
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola) VALUES (5, 'oppilas.hupsunen@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia');
INSERT INTO Kayttaja (ID, sahkoposti, salasanaHash, suola) VALUES (6, 'oppilas.homelo@helsinki.fi', 'asdfgasdfsadfasdsdfaf', 'suolia');

INSERT INTO KayttajaRyhma (ryhmaID, nimi) VALUES (0, 'opiskelija');
INSERT INTO KayttajaRyhma (ryhmaID, nimi) VALUES (1, 'opettaja');
INSERT INTO KayttajaRyhma (ryhmaID, nimi) VALUES (2, 'hallinto');

INSERT INTO Organisaatio (organisaatioID, nimi) VALUES (0, 'tietojenkäsittelytieteen laitos');
INSERT INTO Organisaatio (organisaatioID, nimi) VALUES (1, 'fysiikan laitos');
INSERT INTO Organisaatio (organisaatioID, nimi) VALUES (2, 'matemaattis-luonnontieteellinen tiedekunta');

INSERT INTO RyhmaJasenyys (kayttajaID, ryhmaID, organisaatioID) VALUES (0, 1, 0);
INSERT INTO RyhmaJasenyys (kayttajaID, ryhmaID, organisaatioID) VALUES (1, 0, 0);
INSERT INTO RyhmaJasenyys (kayttajaID, ryhmaID, organisaatioID) VALUES (2, 2, 0);
INSERT INTO RyhmaJasenyys (kayttajaID, ryhmaID, organisaatioID) VALUES (3, 1, 1);
INSERT INTO RyhmaJasenyys (kayttajaID, ryhmaID, organisaatioID) VALUES (4, 0, 1);
INSERT INTO RyhmaJasenyys (kayttajaID, ryhmaID, organisaatioID) VALUES (5, 0, 1);
INSERT INTO RyhmaJasenyys (kayttajaID, ryhmaID, organisaatioID) VALUES (6, 0, 0);

INSERT INTO Kurssi (ID, kurssikoodi, nimi, organisaatioid, kotisivu, alkamispaiva, paattymispaiva) VALUES (0, 123456, 'Tähtitieteen perusteet', 1, NULL, '2016-10-31', '2016-12-21');
INSERT INTO Kurssi (ID, kurssikoodi, nimi, organisaatioid, kotisivu, alkamispaiva, paattymispaiva) VALUES (1, 456789, 'Fysiikan matemaattiset menetelmät Ia', 1, 'http://wiki.helsinki.fi/pages/viewpage.action?pageId=202023686', '2016-09-06', '2016-10-21');
INSERT INTO Kurssi (ID, kurssikoodi, nimi, organisaatioid, kotisivu, alkamispaiva, paattymispaiva) VALUES (2, 715517, 'Aineopintojen harjoitustyö: Tietokantasovellus (periodi II)', 0, 'https://www.cs.helsinki.fi/courses/582203/2016/s/a/2', '2016-10-31', '2016-12-12');
INSERT INTO Kurssi (ID, kurssikoodi, nimi, organisaatioid, kotisivu, alkamispaiva, paattymispaiva) VALUES (3, 258369, 'Höpöhöpötieteen perusteet', 1, 'https://www.google.fi', '2016-10-31', '2016-12-21');

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


INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (0, 0, '1');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (0, 1, '2');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (0, 2, '3');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (0, 3, '4');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (0, 4, '5');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (0, 5, 'En osaa tai halua vastata');

INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (1, 0, 'täysin eri mieltä');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (1, 1, 'osittain eri mieltä');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (1, 2, 'ei samaa eikä eri mieltä');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (1, 3, 'osittain samaa mieltä');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (1, 4, 'täysin samaa mieltä');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (1, 5, 'En osaa tai halua vastata');

INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (2, 0, '1');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (2, 1, '2');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (2, 2, '3');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (2, 3, '4');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (2, 4, '5');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (2, 5, 'En osaa tai halua vastata');

INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (3, 0, '1');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (3, 1, '2');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (3, 2, '3');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (3, 3, '4');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (3, 4, '5');
INSERT INTO Monivalintavaihtoehto (kysymysID, jarjestysluku, teksti) VALUES (3, 5, 'En osaa tai halua vastata');

INSERT INTO Kysymys (ID, organisaatioID, kyselyID, tyyppi, teksti) VALUES (0, NULL, 0, 'monivalinta', 'Anna kokonaisarvosana havaintoexculle');
INSERT INTO Kysymys (ID, organisaatioID, kyselyID, tyyppi, teksti) VALUES (1, NULL, 1, 'monivalinta', 'Sain riittävästi tukea laskareissa');
INSERT INTO Kysymys (ID, organisaatioID, kyselyID, tyyppi, teksti) VALUES (2, 2, NULL, 'monivalinta', 'Anna kokonaisarvosana kurssille');
INSERT INTO Kysymys (ID, organisaatioID, kyselyID, tyyppi, teksti) VALUES (3, 1, NULL, 'monivalinta', 'Anna kokonaisarvosana laskareille');
INSERT INTO Kysymys (ID, organisaatioID, kyselyID, tyyppi, teksti) VALUES (4, NULL, 0, 'avoin', 'Mikä oli parasta kurssilla?');

INSERT INTO Monivalintavastaus (opiskelijaID, kysymysID, jarjestysluku) VALUES (1, 0, 3);
INSERT INTO Monivalintavastaus (opiskelijaID, kysymysID, jarjestysluku) VALUES (1, 2, 4);
INSERT INTO Monivalintavastaus (opiskelijaID, kysymysID, jarjestysluku) VALUES (1, 3, 5);
INSERT INTO Monivalintavastaus (opiskelijaID, kysymysID, jarjestysluku) VALUES (4, 0, 4);
INSERT INTO Monivalintavastaus (opiskelijaID, kysymysID, jarjestysluku) VALUES (4, 2, 2);
INSERT INTO Monivalintavastaus (opiskelijaID, kysymysID, jarjestysluku) VALUES (4, 3, 5);

INSERT INTO AvoinVastaus (opiskelijaID, kysymysID, vastaus) VALUES (1, 4, 'Luennoitsijan innostava asenne');