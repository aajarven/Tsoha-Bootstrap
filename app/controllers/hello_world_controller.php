<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //View::make('home.html');
        echo 'Etusivu =3';
    }

    public static function sandbox() {
        View::make('helloworld.html');
    }

    public static function etusivu() {
        View::make('suunnitelmat/etusivu.html');
    }

    public static function opettajanakyma() {
        View::make('suunnitelmat/opettajanakyma.html');
    }

    public static function opiskelijanakyma() {
        View::make('suunnitelmat/opiskelijanakyma.html');
    }

    public static function laitosnakyma() {
        View::make('suunnitelmat/laitosnakyma.html');
    }
    
    public static function tiedekuntanakyma() {
        View::make('suunnitelmat/tiedekuntanakyma.html');
    }
    
    public static function tulokset_opettaja() {
        View::make('suunnitelmat/tulokset-opettaja.html');
    }
    
    public static function tulokset_hallinto() {
        View::make('suunnitelmat/tulokset-hallinto.html');
    }
    
    public static function muokkaus_kysely() {
        View::make('suunnitelmat/muokkaus-kysely.html');
    }
    
    public static function muokkaus_kysymys() {
        View::make('suunnitelmat/muokkaus-kysymys.html');
    }
}
