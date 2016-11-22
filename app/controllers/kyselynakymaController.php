<?php

class KyselynakymaController extends BaseController{
    public static function kyselyt($id){
        $opiskelijakurssit = Kurssi::opiskelijanKurssit($id);
        $opettajakurssit = Kurssi::opettajanKurssitKyselylla($id);
        $opettajakyselyt = Kysely::opettajanKyselyt($id);
        $kyselyttomatKurssit = Kurssi::opettajanKurssitIlmanKyselya($id);
        View::make('kyselyt.html', array('opiskelijakurssit' => $opiskelijakurssit, 'opettajakurssit' => $opettajakurssit, 'opettajakyselyt' => $opettajakyselyt, 'kyselyttomatKurssit' => $kyselyttomatKurssit));
    }
    
    public static function luonti($kurssiID){
        $kurssi = Kurssi::haeKurssi($kurssiID);
        View::make('luo.html', array('kurssi' => $kurssi));
    }
}

