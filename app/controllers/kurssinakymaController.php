<?php

class KurssinakymaController extends BaseController {
    
    public static function kurssit() {
        $kurssit = Kurssi::haeKaikkiOpettajineen();
        View::make('kurssit.html', array('kurssit' => $kurssit));
    }

//    public static function kyselyt() {
//        $id = $_SESSION['kayttajaID'];
//        $opiskelijakurssit = Kurssi::opiskelijanKurssit($id);
//        $opettajakurssit = Kurssi::opettajanKurssitKyselylla($id);
//        $opettajakyselyt = Kysely::opettajanKyselyt($id);
//        $kyselyttomatKurssit = Kurssi::opettajanKurssitIlmanKyselya($id);
//        View::make('kyselyt.html', array('opiskelijakurssit' => $opiskelijakurssit, 'opettajakurssit' => $opettajakurssit, 'opettajakyselyt' => $opettajakyselyt, 'kyselyttomatKurssit' => $kyselyttomatKurssit));
//    }
//
//    public static function luo($kurssiID) {
//        $kurssi = Kurssi::haeKurssi($kurssiID);
//        $kysely = new Kysely(array(
//            'kurssiID' => $kurssiID
//        ));
//
//        $kysely->save();
//
//        Redirect::to('/kyselyt/muokkaa/' . $kysely->kurssiID, array('message' => 'Kysely luotu'));
//    }
//
//    public static function muokkaaKyselya($kurssiID) {
//        $kysymykset = Kysymys::kyselynKysymykset($kurssiID);
//        $kurssi = Kurssi::haeKurssi($kurssiID);
//
//        View::make('muokkaaKyselya.html', array('kysymykset' => $kysymykset, 'kurssi' => $kurssi));
//    }
//
//    public static function poistaKysely($kyselyID) {
//        $kysely = Kysely::haeKysely($kyselyID);
//        $kysely->poista();
//        Redirect::to('/kyselyt', array('message' => 'Kysely poistettu'));
//    }
//
//    public static function naytaLisayslomake($kurssiID) {
//        $kurssi = Kurssi::haeKurssi($kurssiID);
//
//        View::make('lisaaKysymys.html', array('kurssi' => $kurssi));
//    }
//
//    public static function lisaaKysymys($kurssiID) {
//        $params = $_POST;
//        $kysely = Kysely::haeKurssinKysely($kurssiID);
//        $attributes = array(
//            'teksti' => $params['kysymys']
//        );
//
//        $kysymys = new Kysymys(array(
//            'teksti' => $attributes['teksti'],
//            'kurssiID' => $kurssiID,
//            'kyselyID' => $kysely->ID
//        ));
//
//        $virheet = $kysymys->errors();
//
//        if (count($virheet) == 0) {
//            $kysymys->save();
//            Redirect::to('/kyselyt/muokkaa/' . $kysely->kurssiID);
//        } else {
//            $kurssi = Kurssi::haeKurssi($kurssiID);
//            View::make('lisaaKysymys.html', array('kurssi' => $kurssi, 'virheet' => $virheet, 'attributes' => $attributes));
//        }
//    }
//
//    public static function naytaMuokkauslomake($kysymysID) {
//        $kysymys = Kysymys::haeKysymys($kysymysID);
//        View::make('muokkaaKysymysta.html', array('attributes' => $kysymys));
//    }
//
//    public static function muokkaaKysymys($kysymysID) {
//        $alkuperainenkysymys = Kysymys::haeKysymys($kysymysID);
//        $kysely = Kysely::haeKysely($alkuperainenkysymys->kyselyID);
//        $kurssi = Kurssi::haeKurssi($kysely->kurssiID);
//        $params = $_POST;
//        $attributes = array(
//            'ID' => $kysymysID,
//            'teksti' => $params['kysymys']
//        );
//
//        $kysymys = new Kysymys($attributes);
//        $virheet = $kysymys->errors();
//
//        if (count($virheet) == 0) {
//            $kysymys->update();
//            Redirect::to('/kyselyt/muokkaa/' . $kurssi->ID, array('message' => 'Kysymys muokattu'));
//        } else {
//            $kurssi = Kurssi::haeKurssi($kurssiID);
//            View::make('muokkaaKysymysta.html', array('virheet' => $virheet, 'attributes' => $attributes));
//        }
//    }
//
//    public static function poistaKysymys($kysymysID) {
//        $alkuperainenkysymys = Kysymys::haeKysymys($kysymysID);
//        $kysely = Kysely::haeKysely($alkuperainenkysymys->kyselyID);
//        $kurssi = Kurssi::haeKurssi($kysely->kurssiID);
//
//        $kysymys = new Kysymys(array('ID' => $kysymysID));
//        $kysymys->poista();
//        Redirect::to('/kyselyt/muokkaa/' . $kurssi->ID, array('message' => 'Kysyms poistettu'));
//    }

}
