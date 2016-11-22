<?php

//use Redirect;

class KyselynakymaController extends BaseController {

    public static function kyselyt($id) {
        $opiskelijakurssit = Kurssi::opiskelijanKurssit($id);
        $opettajakurssit = Kurssi::opettajanKurssitKyselylla($id);
        $opettajakyselyt = Kysely::opettajanKyselyt($id);
        $kyselyttomatKurssit = Kurssi::opettajanKurssitIlmanKyselya($id);
        View::make('kyselyt.html', array('opiskelijakurssit' => $opiskelijakurssit, 'opettajakurssit' => $opettajakurssit, 'opettajakyselyt' => $opettajakyselyt, 'kyselyttomatKurssit' => $kyselyttomatKurssit));
    }

    public static function luo($kurssiID) {
        $kurssi = Kurssi::haeKurssi($kurssiID);
        $kysely = new Kysely(array(
            'kurssiID' => $kurssiID
        ));

        $kysely->save();

        Redirect::to('/kyselyt/muokkaa/' . $kysely->kurssiID);
    }

    public static function muokkaaKyselya($kurssiID) {
        $kysymykset = Kysymys::kyselynKysymykset($kurssiID);
        $kurssi = Kurssi::haeKurssi($kurssiID);

        View::make('muokkaaKyselya.html', array('kysymykset' => $kysymykset, 'kurssi' => $kurssi));
    }

    public static function naytaLisayslomake($kurssiID) {
        $kurssi = Kurssi::haeKurssi($kurssiID);

        View::make('lisaaKysymys.html', array('kurssi' => $kurssi));
    }

    public static function lisaaKysymys($kurssiID) {
        $params = $_POST;
        $kysely = Kysely::haeKurssinKysely($kurssiID);
        $kysymys = new Kysymys(array(
            'teksti' => $params['kysymys'],
            'kurssiID' => $kurssiID,
            'kyselyID' => $kysely->ID
        ));
        
        $kysymys->save();
    }

}
