<?php

class KirjautumisController extends BaseController {

    public static function naytaKirjautumissivu() {
        View::make('kirjautumissivu.html');
    }

    public static function kirjaudu() {
        $params = $_POST;

        $kayttaja = Kayttaja::kirjaudu($params['sahkoposti'], $params['salasana']);

        if (!$kayttaja) {
            View::make('kirjautumissivu.html', array('virhe' => 'Virheellinen sähköposti tai salasana', 'sahkoposti' => $params['sahkoposti']));
        } else {
            $_SESSION['kayttajaID'] = $kayttaja->ID;
            $_SESSION['hallintohenkilo'] = $kayttaja->hallintohenkilo;

            if ($kayttaja->hallintohenkilo) {
                Redirect::to('/kurssit');
            } else {
                Redirect::to('/kyselyt');
            }
        }
    }

    public static function uloskirjaa() {
        $_SESSION['kayttajaID'] = NULL;
        $_SESSION['hallintohenkilo'] = false;
        Redirect::to('/kirjaudu');
    }

}
