<?php

class Kurssi extends BaseModel {

    public $ID, $kurssikoodi, $nimi, $kotisivu, $alkamispaiva, $paattymispaiva;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function opiskelijanKurssit($opiskelijaID) {
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

        foreach ($rivit as $kurssi) {
            $kurssit[] = new Kurssi(array(
                'ID' => $kurssi['id'],
                'kurssikoodi' => $kurssi['kurssikoodi'],
                'nimi' => $kurssi['nimi'],
                'kotisivu' => $kurssi['kotisivu'],
                'alkamispaiva' => $kurssi['alkamispaiva'],
                'paattymispaiva' => $kurssi['paattymispaiva']
            ));
        }

        return $kurssit;
    }

    public static function opettajanKurssitKyselylla($opettajaID) {
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

        foreach ($rivit as $kurssi) {
            $kurssit[] = new Kurssi(array(
                'ID' => $kurssi['id'],
                'kurssikoodi' => $kurssi['kurssikoodi'],
                'nimi' => $kurssi['nimi'],
                'kotisivu' => $kurssi['kotisivu'],
                'alkamispaiva' => $kurssi['alkamispaiva'],
                'paattymispaiva' => $kurssi['paattymispaiva']
            ));
        }

        return $kurssit;
    }

    public static function opettajanKurssitIlmanKyselya($opettajaID) {
        $query = DB::connection()->prepare('SELECT * '
                . 'FROM '
                . '(SELECT Kurssi.ID, Kurssi.kurssikoodi, Kurssi.nimi, Kurssi.kotisivu, Kurssi.alkamispaiva, Kurssi.paattymispaiva '
                . 'FROM Kysely FULL OUTER JOIN Kurssi '
                . 'ON Kysely.kurssiID = Kurssi.ID '
                . 'WHERE Kysely.ID IS NULL) AS kurssi, '
                . 'KurssinOpettaja '
                . 'WHERE KurssinOpettaja.kurssiID = kurssi.ID '
                . 'AND KurssinOpettaja.HenkiloID = :ID;');
        $query->execute(array('ID' => $opettajaID));
        $rivit = $query->fetchAll();

        $kurssit = array();

        foreach ($rivit as $kurssi) {
            $kurssit[] = new Kurssi(array(
                'ID' => $kurssi['id'],
                'kurssikoodi' => $kurssi['kurssikoodi'],
                'nimi' => $kurssi['nimi'],
                'kotisivu' => $kurssi['kotisivu'],
                'alkamispaiva' => $kurssi['alkamispaiva'],
                'paattymispaiva' => $kurssi['paattymispaiva']
            ));
        }

        return $kurssit;
    }

    public static function haeKurssi($kurssiID) {
        $query = DB::connection()->prepare('SELECT Kurssi.ID, '
                . 'kurssi.kurssikoodi, '
                . 'kurssi.nimi, '
                . 'kurssi.kotisivu, '
                . 'kurssi.alkamispaiva, '
                . 'kurssi.paattymispaiva '
                . 'FROM Kurssi '
                . 'WHERE Kurssi.ID = :ID');
        $query->execute(array('ID' => $kurssiID));
        $rivi = $query->fetch();

        $kurssi = new Kurssi(array(
            'ID' => $rivi['id'],
            'kurssikoodi' => $rivi['kurssikoodi'],
            'nimi' => $rivi['nimi'],
            'kotisivu' => $rivi['kotisivu'],
            'alkamispaiva' => $rivi['alkamispaiva'],
            'paattymispaiva' => $rivi['paattymispaiva']
        ));

        return $kurssi;
    }

}