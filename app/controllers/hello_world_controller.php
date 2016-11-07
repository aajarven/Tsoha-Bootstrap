<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  //View::make('home.html');
        echo 'Etusivu =3';
    }

    public static function sandbox(){
        View::make('helloworld.html');
    }
  }
