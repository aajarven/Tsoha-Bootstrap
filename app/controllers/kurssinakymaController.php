<?php

class KurssinakymaController extends BaseController {

    public static function kurssit() {
        $kurssit = Kurssi::haeKaikkiOpettajineen();
        View::make('kurssit.html', array('kurssit' => $kurssit));
    }

    public static function muokkaaKurssia() {
        $params = $_POST;

        $kurssi = Kurssi::haeKurssi($params['kurssiID']);
        $opettajat = Kayttaja::haeEiHallintohenkilot();
        $kurssinOpettajat = Kayttaja::haeKurssinOpettajat($params['kurssiID']);
        View::make('muokkaaKurssia.html', array('kurssi' => $kurssi, 'opettajat' => $opettajat, 'nykyisetOpettajat' => $kurssinOpettajat));
    }

    public static function tallennaMuutokset() {
        $params = $_POST;
        
        $attributes = array(
            'ID' => $params['kurssiID'],
            'kurssikoodi' => $params['kurssikoodi'],
            'nimi' => $params['nimi'],
            'kotisivu' => $params['kotisivu'],
            'alkamispaiva' => new DateTime($params['alkamispaiva']),
            'paattymispaiva' => new DateTime($params['paattymispaiva'])
        );
        
        $opettajaIDt = array();
        foreach($params['opettajat'] as $opettaja){
            $opettajaIDt[] = $opettaja;
        }

        $kurssi = new Kurssi($attributes);
        $virheet = $kurssi->errors();

        if (count($virheet) == 0) {
            $kurssi->update();
            $kurssi->paivitaOpettajat($opettajaIDt);
            Redirect::to('/kurssit', array('message' => 'Kurssi muokattu'));
        } else {
            $kurssi = Kurssi::haeKurssi($kurssiID);
            View::make('muokkaaKurssia.html', array('virheet' => $virheet, 'attributes' => $attributes));
        }
    }
    
    public static function naytaLuontinakyma(){
        $opettajat = Kayttaja::haeEiHallintohenkilot();
        View::make('lisaaKurssi.html', array('opettajat' => $opettajat));
    }
    
    public static function luoKurssi() {
        $params = $_POST;

        $attributes = array(
            'kurssikoodi' => $params['kurssikoodi'],
            'nimi' => $params['nimi'],
            'kotisivu' => $params['kotisivu'],
            'alkamispaiva' => new DateTime($params['alkamispaiva']),
            'paattymispaiva' => new DateTime($params['paattymispaiva'])
        );
        
        $kurssi = new Kurssi($attributes);

        $virheet = $kurssi->errors();

        if (count($virheet) == 0) {
            $kurssi->luo();
            Redirect::to('/kurssit', array('message' => 'Kurssi lisätty'));
        } else {
            $kurssi = Kurssi::haeKurssi($kurssiID);
            $opettajat = Kayttaja::haeEiHallintohenkilot();
            View::make('lisaaKurssi.html', array('kurssi' => $kurssi, 'virheet' => $virheet, 'attributes' => $attributes, 'opettajat' => $opettajat));
        }
    }
    
}