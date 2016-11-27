<?php

class KirjautumisController extends BaseController {
    public static function naytaKirjautumissivu(){
        View::make('kirjautumissivu.html');
    }
    
    public static function kirjaudu(){
    $params = $_POST;

    $kayttaja = Kayttaja::kirjaudu($params['sahkoposti'], $params['salasana']);

    if(!$kayttaja){
      View::make('kirjautumissivu.html', array('error' => 'Virheellinen sähköposti tai salasana', 'sahkoposti' => $params['sahkoposti']));
    }else{
      $_SESSION['kayttaja'] = $kayttaja->ID;

      Redirect::to('/kyselyt/'.$kayttaja->ID);
    }
  }
}

