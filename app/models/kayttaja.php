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
}
