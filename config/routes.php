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

$routes->post('/kysymys/lisaa/:ID', 'check_logged_in', function($kurssiID) {
    KyselynakymaController::lisaaKysymys($kurssiID);
});

$routes->get('/kysymys/lisaa/:ID', 'check_logged_in', function($kurssiID) {
    KyselynakymaController::naytaLisayslomake($kurssiID);
});

$routes->get('/kyselyt/luo/:id', 'check_logged_in', function($kurssiID) {
    KyselynakymaController::luo($kurssiID);
});

$routes->get('/kyselyt/muokkaa/:id', 'check_logged_in', function($kurssiID) {
    KyselynakymaController::muokkaaKyselya($kurssiID);
});

$routes->get('/kysymys/muokkaa/:id', 'check_logged_in', function($kysymysID) {
    KyselynakymaController::naytaMuokkauslomake($kysymysID);
});

$routes->post('/kysymys/muokkaa/:id', 'check_logged_in', function($kysymysID) {
    KyselynakymaController::muokkaaKysymys($kysymysID);
});

$routes->get('/kysymys/poista/:id', 'check_logged_in', function($kysymysID) {
    KyselynakymaController::poistaKysymys($kysymysID);
});

$routes->get('/kysely/poista/:id', 'check_logged_in', function($kyselyID) {
    KyselynakymaController::poistaKysely($kyselyID);
});

$routes->get('/kyselyt/', 'check_logged_in', function() {
    KyselynakymaController::kyselyt();
});
//
//$routes->get('/', function() {
//    HelloWorldController::index();
//});
//
//$routes->get('/hiekkalaatikko', function() {
//    HelloWorldController::sandbox();
//});
//
//$routes->get('/etusivu', function() {
//    HelloWorldController::etusivu();
//});
//
//$routes->get('/opettajanakyma', function() {
//    HelloWorldController::opettajanakyma();
//});
//
//$routes->get('/laitosnakyma', function() {
//    HelloWorldController::laitosnakyma();
//});
//
//$routes->get('/tiedekuntanakyma', function() {
//    HelloWorldController::tiedekuntanakyma();
//});
//
//$routes->get('/tulokset-opettaja', function() {
//    HelloWorldController::tulokset_opettaja();
//});
//
//$routes->get('/tulokset-hallinto', function() {
//    HelloWorldController::tulokset_hallinto();
//});
//
//$routes->get('/muokkaus-kysely', function() {
//    HelloWorldController::muokkaus_kysely();
//});
//
//$routes->get('/muokkaus-kysymys', function() {
//    HelloWorldController::muokkaus_kysymys();
//});
//
//$routes->get('/kysely', function() {
//    HelloWorldController::kysely();
//});
//
//$routes->get('/muokkaus-kysymyspaletti', function() {
//    HelloWorldController::muokkaus_kysymyspaletti();
//});
//
//$routes->get('/muokkaus-kurssi', function() {
//    HelloWorldController::muokkaus_kurssi();
//});