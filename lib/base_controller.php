<?php

class BaseController {

    public static function get_user_logged_in() {
        // Katsotaan onko user-avain sessiossa
        if (isset($_SESSION['kayttajaID'])) {
            $kayttajaID = $_SESSION['kayttajaID'];
            // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
            $kayttaja = Kayttaja::haeKayttaja($kayttajaID);

            return $kayttaja;
        }

        // Käyttäjä ei ole kirjautunut sisään
        return null;
    }

    public static function check_logged_in() {
        if (BaseController::get_user_logged_in() == null){
            Redirect::to('{{base_url}}/kirjaudu');
        }
    }

}
