<?php

$routes->post('/kysymys/lisaa/:ID', function($kurssiID){
    KyselynakymaController::lisaaKysymys($kurssiID);
});

$routes->get('/kysymys/lisaa/:ID', function($kurssiID){
    KyselynakymaController::naytaLisayslomake($kurssiID);
});

$routes->get('/kyselyt/luo/:id', function($kurssiID){
    KyselynakymaController::luo($kurssiID);
});

$routes->get('/kyselyt/muokkaa/:id', function($kurssiID){
    KyselynakymaController::muokkaaKyselya($kurssiID);
});

$routes->get('/kysymys/muokkaa/:id', function($kysymysID){
    KyselynakymaController::naytaMuokkauslomake($kysymysID);
});

$routes->post('/kysymys/muokkaa/:id', function($kysymysID){
    KyselynakymaController::muokkaaKysymys($kysymysID);
});

$routes->get('/kysymys/poista/:id', function($kysymysID){
    KyselynakymaController::poistaKysymys($kysymysID);
});

$routes->get('/kyselyt/:id', function($id) {
    KyselynakymaController::kyselyt($id);
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