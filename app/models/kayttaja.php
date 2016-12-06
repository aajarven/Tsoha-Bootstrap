<?php

class Kayttaja extends BaseModel {
    public $ID, $sahkoposti, $salasanaHash, $suola, $hallintohenkilo;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function kirjaudu($sahkoposti, $salasana){        
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja '
                . 'WHERE sahkoposti = :sahkoposti');
        $query->execute(array('sahkoposti' => $sahkoposti));
        
        $rivi = $query->fetch();
        
        $kayttaja = new Kayttaja(array(
            'ID' => $rivi['id'],
            'sahkoposti' => $rivi['sahkoposti'],
            'salasanaHash' => $rivi['salasanahash'],
            'suola' => $rivi['suola'],
            'hallintohenkilo' => $rivi['hallintohenkilo']
        ));
        
        if (crypt($salasana, $kayttaja->suola) == $kayttaja->salasanaHash){
            return $kayttaja;
        } else {
            return null;
        }
        
    }
    
    public function haeKayttaja($kayttajaID){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja '
                . 'WHERE ID = :ID');
        $query->execute(array('ID' => $kayttajaID));
        
        $rivi = $query->fetch();
        
        $kayttaja = new Kayttaja(array(
            'ID' => $rivi['id'],
            'sahkoposti' => $rivi['sahkoposti'],
            'salasanaHash' => $rivi['salasanahash'],
            'suola' => $rivi['suola'],
            'hallintohenkilo' => $rivi['hallintohenkilo']
        ));
        
        return $kayttaja;
    }
    
    public function haeEiHallintohenkilot(){
        $query = DB::connection()->prepare('SELECT ID, sahkoposti '
                . 'FROM Kayttaja '
                . 'WHERE hallintohenkilo = false');
        $query->execute();
        $rivit = $query->fetchAll();

        $henkilot= array();

        foreach ($rivit as $henkilo) {
            $henkilot[] = new Kayttaja(array(
                'ID' => $henkilo['id'],
                'sahkoposti' => $henkilo['sahkoposti']
            ));
        }

        return $henkilot;
    }
    
    public function haeKurssinOpettajat($kurssiID){
        $query = DB::connection()->prepare('SELECT ID, sahkoposti '
                . 'FROM Kayttaja, KurssinOpettaja '
                . 'WHERE Kayttaja.ID = KurssinOpettaja.henkiloID '
                . 'AND KurssinOpettaja.kurssiID = :ID');
        $query->execute(array('ID' => $kurssiID));
        $rivit = $query->fetchAll();

        $henkilot= array();

        foreach ($rivit as $henkilo) {
            $henkilot[] = new Kayttaja(array(
                'ID' => $henkilo['id'],
                'sahkoposti' => $henkilo['sahkoposti']
            ));
        }

        return $henkilot;
    }
}
