<?php

class KysymysController extends BaseController {
    
        public static function muokkaaKysymys($kysymysID) {
        $alkuperainenkysymys = Kysymys::haeKysymys($kysymysID);
        $kysely = Kysely::haeKysely($alkuperainenkysymys->kyselyID);
        $kurssi = Kurssi::haeKurssi($kysely->kurssiID);
        $params = $_POST;
        $attributes = array(
            'ID' => $kysymysID,
            'teksti' => $params['kysymys']
        );

        $kysymys = new Kysymys($attributes);
        $virheet = $kysymys->errors();

        if (count($virheet) == 0) {
            $kysymys->update();
            Redirect::to('/kyselyt/muokkaa/' . $kurssi->ID, array('message' => 'Kysymys muokattu'));
        } else {
            $kurssi = Kurssi::haeKurssi($kurssi->ID);
            View::make('muokkaaKysymysta.html', array('virheet' => $virheet, 'attributes' => $attributes));
        }
    }
    
    public static function poistaKysymys($kysymysID) {
        $alkuperainenkysymys = Kysymys::haeKysymys($kysymysID);
        $kysely = Kysely::haeKysely($alkuperainenkysymys->kyselyID);
        $kurssi = Kurssi::haeKurssi($kysely->kurssiID);

        $kysymys = new Kysymys(array('ID' => $kysymysID));
        $kysymys->poista();
        Redirect::to('/kyselyt/muokkaa/' . $kurssi->ID, array('message' => 'Kysyms poistettu'));
    }
    
        public static function naytaMuokkauslomake($kysymysID) {
        $kysymys = Kysymys::haeKysymys($kysymysID);
        View::make('muokkaaKysymysta.html', array('attributes' => $kysymys));
    }
    
        public static function naytaLisayslomake($kurssiID) {
        $kurssi = Kurssi::haeKurssi($kurssiID);

        View::make('lisaaKysymys.html', array('kurssi' => $kurssi));
    }

    public static function lisaaKysymys($kurssiID) {
        $params = $_POST;
        $kysely = Kysely::haeKurssinKysely($kurssiID);
        $attributes = array(
            'teksti' => $params['kysymys']
        );

        $kysymys = new Kysymys(array(
            'teksti' => $attributes['teksti'],
            'kurssiID' => $kurssiID,
            'kyselyID' => $kysely->ID
        ));

        $virheet = $kysymys->errors();

        if (count($virheet) == 0) {
            $kysymys->save();
            Redirect::to('/kyselyt/muokkaa/' . $kysely->kurssiID);
        } else {
            $kurssi = Kurssi::haeKurssi($kurssiID);
            View::make('lisaaKysymys.html', array('kurssi' => $kurssi, 'virheet' => $virheet, 'attributes' => $attributes));
        }
    }
    
    public static function muutaStatus(){
        $params = $_POST;
        $kysely = Kysely::haeKurssinKysely($params['kurssiID']);
        Kysely::muutaTilaa($kysely->ID);
        
        Redirect::to('/kyselyt/', array('message' => 'Tila muutettu'));
    }
}

