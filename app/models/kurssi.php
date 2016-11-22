<?php

class Kurssi extends BaseModel{
    public $ID, $kurssikoodi, $nimi, $kotisivu, $alkamispaiva, $paattymispaiva;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function opiskelijanKurssit($opiskelijaID){
        $query = DB::connection()->prepare('SELECT Kurssi.ID, '
                . 'kurssi.kurssikoodi, '
                . 'kurssi.nimi, '
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
                'kotisivu' => $kurssi['kotisivu'],
                'alkamispaiva' => $kurssi['alkamispaiva'],
                'paattymispaiva' => $kurssi['paattymispaiva']
            ));
        }
        
        return $kurssit;
    }
    
    public static function opettajanKurssit($opettajaID){
        $query = DB::connection()->prepare('SELECT Kurssi.ID, '
                . 'kurssi.kurssikoodi, '
                . 'kurssi.nimi, '
                . 'kurssi.kotisivu, '
                . 'kurssi.alkamispaiva, '
                . 'kurssi.paattymispaiva, '
                . 'tila.ID as jarjestys '
                . 'FROM Kurssi, Kysely, Tila, KurssinOpettaja WHERE '
                . 'Kurssi.ID = Kysely.kurssiID '
                . 'AND Kysely.status = Tila.ID '
                . 'AND KurssinOpettaja.KurssiID = Kurssi.ID '
                . 'AND KurssinOpettaja.henkiloID =:ID '
                . 'ORDER BY jarjestys, ID');
        $query->execute(array('ID' => $opettajaID));
        $rivit = $query->fetchAll();
        
        $kurssit = array();
        
        foreach($rivit as $kurssi){
            $kurssit[] = new Kurssi(array(
                'id' => $kurssi['id'],
                'kurssikoodi' => $kurssi['kurssikoodi'],
                'nimi' => $kurssi['nimi'],
                'kotisivu' => $kurssi['kotisivu'],
                'alkamispaiva' => $kurssi['alkamispaiva'],
                'paattymispaiva' => $kurssi['paattymispaiva']
            ));
        }
        
        return $kurssit;
    }
}
