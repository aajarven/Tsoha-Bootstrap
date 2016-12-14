<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/', 'check_logged_in', function() {
    if ($_SESSION['hallintohenkilo']) {
        KurssinakymaController::kurssit();
    } else {
        KyselynakymaController::kyselyt();
    }
});

$routes->get('/kirjaudu', function() {
    KirjautumisController::naytaKirjautumissivu();
});

$routes->post('/kirjaudu', function() {
    KirjautumisController::kirjaudu();
});

$routes->post('/logout', function() {
    KirjautumisController::uloskirjaa();
});

$routes->get('/kurssit', 'check_logged_in', function() {
    KurssinakymaController::kurssit();
});

$routes->post('/kurssit', 'check_logged_in', function() {
    KurssinakymaController::muokkaaKurssia();
});

$routes->post('/kurssit/muokkaa', 'check_logged_in', function() {
    KurssinakymaController::tallennaMuutokset();
});

$routes->post('/kysymys/lisaa/:ID', 'check_logged_in', function($kurssiID) {
    KysymysController::lisaaKysymys($kurssiID);
});

$routes->get('/kysymys/lisaa/:ID', 'check_logged_in', function($kurssiID) {
    KysymysController::naytaLisayslomake($kurssiID);
});

$routes->get('/kyselyt/luo/:id', 'check_logged_in', function($kurssiID) {
    KyselynakymaController::luo($kurssiID);
});

$routes->get('/kyselyt/muokkaa/:id', 'check_logged_in', function($kurssiID) {
    KyselynakymaController::muokkaaKyselya($kurssiID);
});

$routes->get('/kysymys/muokkaa/:id', 'check_logged_in', function($kysymysID) {
    KysymysController::naytaMuokkauslomake($kysymysID);
});

$routes->post('/kysymys/muokkaa/:id', 'check_logged_in', function($kysymysID) {
    KysymysController::muokkaaKysymys($kysymysID);
});

$routes->get('/kysymys/poista/:id', 'check_logged_in', function($kysymysID) {
    KysymysController::poistaKysymys($kysymysID);
});

$routes->get('/kysely/poista/:id', 'check_logged_in', function($kyselyID) {
    KyselynakymaController::poistaKysely($kyselyID);
});

$routes->get('/kyselyt/', 'check_logged_in', function() {
    KyselynakymaController::kyselyt();
});

$routes->post('/kyselyt/', 'check_logged_in', function() {
    KysymysController::muutaStatus();
});