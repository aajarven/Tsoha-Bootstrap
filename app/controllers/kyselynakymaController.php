<?php

class KyselynakymaController extends BaseController{
    public static function kyselyt($id){
        $opiskelijakurssit = Kurssi::opiskelijanKurssit($id);
        $opettajakurssit = Kurssi::opettajanKurssit($id);
        $opettajakyselyt = Kysely::opettajanKyselyt($id);
        View::make('kyselyt.html', array('opiskelijakurssit' => $opiskelijakurssit, 'opettajakurssit' => $opettajakurssit, 'opettajakyselyt' => $opettajakyselyt));
    }
}

