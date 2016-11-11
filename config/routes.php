<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
});

$routes->get('/opettajanakyma', function() {
    HelloWorldController::opettajanakyma();
});

$routes->get('/opiskelijanakyma', function() {
    HelloWorldController::opiskelijanakyma();
});

$routes->get('/laitosnakyma', function() {
    HelloWorldController::laitosnakyma();
});

$routes->get('/tiedekuntanakyma', function() {
    HelloWorldController::tiedekuntanakyma();
});

$routes->get('/tulokset-opettaja', function() {
    HelloWorldController::tulokset_opettaja();
});

$routes->get('/tulokset-hallinto', function() {
    HelloWorldController::tulokset_hallinto();
});

$routes->get('/muokkaus-kysely', function() {
    HelloWorldController::muokkaus_kysely();
});

$routes->get('/muokkaus-kysymys', function() {
    HelloWorldController::muokkaus_kysymys();
});

$routes->get('/kysely', function() {
    HelloWorldController::kysely();
});