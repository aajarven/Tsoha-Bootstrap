<?php

//use Redirect;

class KyselynakymaController extends BaseController{
    public static function kyselyt($id){
        $opiskelijakurssit = Kurssi::opiskelijanKurssit($id);
        $opettajakurssit = Kurssi::opettajanKurssitKyselylla($id);
        $opettajakyselyt = Kysely::opettajanKyselyt($id);
        $kyselyttomatKurssit = Kurssi::opettajanKurssitIlmanKyselya($id);
        View::make('kyselyt.html', array('opiskelijakurssit' => $opiskelijakurssit, 'opettajakurssit' => $opettajakurssit, 'opettajakyselyt' => $opettajakyselyt, 'kyselyttomatKurssit' => $kyselyttomatKurssit));
    }
    
    public static function luo($kurssiID){
        $kurssi = Kurssi::haeKurssi($kurssiID);
        $kysely = new Kysely(array(
            'kurssiID' => $kurssiID
        ));
        
        $kysely->save();
        
        Redirect::to('/kyselyt/muokkaa/'.$kysely->kurssiID);
    }
    
    public static function muokkaaKyselya($kurssiID){
        $kysymykset = Kysymys::kyselynKysymykset($kurssiID);
        
        View::make('kyselyt.html', array('kysymykset' => $kysymykset));
    }
}

