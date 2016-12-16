<?php

//use Redirect;

class KyselynakymaController extends BaseController {

    public static function kyselyt() {
        $id = $_SESSION['kayttajaID'];
        $opiskelijakurssit = Kurssi::opiskelijanVastaamattomatKurssit($id);
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

        Redirect::to('/kyselyt/muokkaa/' . $kysely->kurssiID, array('message' => 'Kysely luotu'));
    }

    public static function muokkaaKyselya($kurssiID) {
        $kysymykset = Kysymys::kyselynKysymykset($kurssiID);
        $kurssi = Kurssi::haeKurssi($kurssiID);

        View::make('muokkaaKyselya.html', array('kysymykset' => $kysymykset, 'kurssi' => $kurssi));
    }

    public static function poistaKysely($kyselyID) {
        $kysely = Kysely::haeKysely($kyselyID);
        $kysely->poista();
        Redirect::to('/kyselyt', array('message' => 'Kysely poistettu'));
    }
    
    public static function naytaVastauslomake(){
        $params = $_POST;
        $kurssiID = $params['kurssiID'];
        $kysymykset = Kysymys::kyselynKysymykset($kurssiID);
        $kurssi = Kurssi::haeKurssi($kurssiID);
        
        View::make('vastaaKyselyyn.html', array('kysymykset' => $kysymykset, 'kurssi' => $kurssi));
    }
    
    public static function tallennaVastaukset(){
        $params = $_POST;
        $kysymykset = Kysymys::kyselynKysymykset($params['kurssiID']);
        $kayttajaID = $_SESSION['kayttajaID'];
        
        foreach ($kysymykset as $kysymys){
            $vastaus = new Vastaus(array('opiskelijaID' => $kayttajaID, 'kysymysID' => $kysymys->ID, 'vastaus' => intval($params[$kysymys->ID])));
            $vastaus->lisaaVastaus();
        }
        
        Redirect::to('/kyselyt', array('message' => 'Vastaukset tallennettu'));
        
    }

}
