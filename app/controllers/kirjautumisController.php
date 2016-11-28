<?php

class KirjautumisController extends BaseController {
    public static function naytaKirjautumissivu(){
        View::make('kirjautumissivu.html');
    }
    
    public static function kirjaudu(){
    $params = $_POST;

    $kayttaja = Kayttaja::kirjaudu($params['sahkoposti'], $params['salasana']);

    if(!$kayttaja){
      View::make('kirjautumissivu.html', array('virhe' => 'Virheellinen sähköposti tai salasana', 'sahkoposti' => $params['sahkoposti']));
    }else{
      $_SESSION['kayttajaID'] = $kayttaja->ID;

      Redirect::to('/kyselyt/');
    }
  }
}

