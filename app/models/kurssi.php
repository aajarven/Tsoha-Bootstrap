<?php

class Kurssi extends BaseModel{
    public $ID, $kurssikoodi, $nimi, $organisaatioID, $kotisivu, $alkamispaiva, $paattymispaiva;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function opiskelijanKurssit($opiskelijaID){
        $query = DB::connection()->prepare('SELECT Kurssi.ID, '
                . 'kurssi.kurssikoodi, '
                . 'kurssi.nimi, '
                . 'kurssi.organisaatioid, '
                . 'kurssi.kotisivu, '
                . 'kurssi.alkamispaiva, '
                . 'kurssi.paattymispaiva '
                . 'FROM Kurssi, Kysely, Tila, KurssinOsallistuja WHERE '
                . 'Kurssi.ID = Kysely.kurssiID '
                . 'AND Kysely.status = Tila.ID '
                . 'AND KurssinOsallistuja.KurssiID = Kurssi.ID '
                . 'AND KurssinOsallistuja.henkiloID =:ID '
                . 'AND Tila.nimi ~ \'käynnissä\'');
        $query->execute(array('ID' => $opiskelijaID));
        $rivit = $query->fetchAll();
        
        $kurssit = array();
        
        foreach($rivit as $kurssi){
            $kurssit[] = new Kurssi(array(
                'id' => $kurssi['id'],
                'kurssikoodi' => $kurssi['kurssikoodi'],
                'nimi' => $kurssi['nimi'],
                'organisaatioid' => $kurssi['organisaatioid'],
                'kotisivu' => $kurssi['kotisivu'],
                'alkamispaiva' => $kurssi['alkamispaiva'],
                'paattymispaiva' => $kurssi['paattymispaiva']
            ));
        }
        
        return $kurssit;
    }
}
