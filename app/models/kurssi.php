<?php

class Kurssi extends BaseModel {

    public $ID, $kurssikoodi, $nimi, $kotisivu, $alkamispaiva, $paattymispaiva, $opettajat;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoiKoodi', 'validoiNimi', 'validoiKotisivu', 'validoiAlkupvm', 'validoiLoppupvm');
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
                'alkamispaiva' => new DateTime($kurssi['alkamispaiva']),
                'paattymispaiva' => new DateTime($kurssi['paattymispaiva'])
            ));
        }

        return $kurssit;
    }
    
    public static function opiskelijanVastaamattomatKurssit($opiskelijaID) {
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
                . 'AND Tila.nimi ~ \'käynnissä\''
                . 'AND Kurssi.ID NOT IN '
                . '(SELECT Kysely.kurssiID '
                . 'FROM Kysely, Kysymys, Vastaus '
                . 'WHERE Kysely.ID = Kysymys.kyselyID '
                . 'AND Vastaus.kysymysID = Kysymys.ID '
                . 'AND Vastaus.opiskelijaID = :ID)');
        $query->execute(array('ID' => $opiskelijaID));
        $rivit = $query->fetchAll();

        $kurssit = array();

        foreach ($rivit as $kurssi) {
            $kurssit[] = new Kurssi(array(
                'ID' => $kurssi['id'],
                'kurssikoodi' => $kurssi['kurssikoodi'],
                'nimi' => $kurssi['nimi'],
                'kotisivu' => $kurssi['kotisivu'],
                'alkamispaiva' => new DateTime($kurssi['alkamispaiva']),
                'paattymispaiva' => new DateTime($kurssi['paattymispaiva'])
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
                'alkamispaiva' => new DateTime($kurssi['alkamispaiva']),
                'paattymispaiva' => new DateTime($kurssi['paattymispaiva'])
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
                'alkamispaiva' => new DateTime($kurssi['alkamispaiva']),
                'paattymispaiva' => new DateTime($kurssi['paattymispaiva'])
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
            'alkamispaiva' => new DateTime($rivi['alkamispaiva']),
            'paattymispaiva' => new DateTime($rivi['paattymispaiva'])
        ));

        return $kurssi;
    }

    public static function haeKaikkiOpettajineen() {
        $kurssikysely = DB::connection()->prepare('SELECT Kurssi.ID, '
                . 'kurssi.kurssikoodi, '
                . 'kurssi.nimi, '
                . 'kurssi.kotisivu, '
                . 'kurssi.alkamispaiva, '
                . 'kurssi.paattymispaiva '
                . 'FROM Kurssi '
                . 'ORDER BY kurssi.ID');
        $kurssikysely->execute();
        $kurssit = $kurssikysely->fetchAll();

        $opettajakysely = DB::connection()->prepare('SELECT Kayttaja.ID, '
                . 'Kayttaja.sahkoposti, '
                . 'KurssinOpettaja.kurssiID '
                . 'FROM Kayttaja, KurssinOpettaja '
                . 'WHERE KurssinOpettaja.henkiloID = Kayttaja.ID '
                . 'ORDER BY KurssinOpettaja.kurssiID');
        $opettajakysely->execute();
        $kaikkiOpettajat = $opettajakysely->fetchAll();

        $palautettavat = array();

        $opettajaindeksi = 0;

        foreach ($kurssit as $kurssi) {
            $opettajat = array();
            while ($opettajaindeksi < count($kaikkiOpettajat) && $kaikkiOpettajat[$opettajaindeksi]['kurssiid'] == $kurssi['id']) {
                $opettajat[] = $kaikkiOpettajat[$opettajaindeksi]['sahkoposti'];
                $opettajaindeksi++;
            }
            $palautettavat[] = new Kurssi(array(
                'ID' => $kurssi['id'],
                'kurssikoodi' => $kurssi['kurssikoodi'],
                'nimi' => $kurssi['nimi'],
                'kotisivu' => $kurssi['kotisivu'],
                'alkamispaiva' => new DateTime($kurssi['alkamispaiva']),
                'paattymispaiva' => new DateTime($kurssi['paattymispaiva']),
                'opettajat' => $opettajat
            ));
        }

        return $palautettavat;
    }

    public function validoiNimi() {
        $virheet = $this->{'validoiEiNull'}($this->nimi, "Kurssin nimiei voi olla tyhjä");
        $virheet = array_merge($virheet, $this->{'validoiMaksimipituus'}($this->nimi, 150, "Kurssin nimen maksimipituus on 150 merkkiä"));
        return $virheet;
    }

    public function validoiKotisivu() {
        $virheet = $this->{'validoiMaksimipituus'}($this->kotisivu, 500, "Kurssin nimen maksimipituus on 500 merkkiä");
        return $virheet;
    }

    public function validoiKoodi() {
        $virheet = $this->{'validoiOnPositiivinenLuku'}($this->kurssikoodi, "Kurssikoodin tulee olla positiivinen luku");
        return $virheet;
    }

    public function validoiAlkupvm() {
        $virheet = array();

        if ($this->alkamispaiva == false) {
            $virheet[] = "Virheellinen alkamispäivä";
        }
        return $virheet;
    }

    public function validoiLoppupvm() {
        $virheet = array();

        if ($this->paattymispaiva == false) {
            $virheet = "Virheellinen päättymispäivä";
        }

        return $virheet;
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Kurssi '
                . 'SET kurssikoodi = :kurssikoodi, '
                . 'nimi = :nimi, '
                . 'kotisivu = :kotisivu, '
                . 'alkamispaiva = :alkamispaiva, '
                . 'paattymispaiva = :paattymispaiva '
                . 'WHERE ID = :ID');
        $query->execute(array('ID' => $this->ID, 'kurssikoodi' => $this->kurssikoodi, 'nimi' => $this->nimi, 'kotisivu' => $this->kotisivu, 'alkamispaiva' => date('Y-m-d', $this->alkamispaiva->getTimestamp()), 'paattymispaiva' => date('Y-m-d', $this->paattymispaiva->getTimestamp())));
    }

    public function paivitaOpettajat($opettajaIDt) {
        $query = DB::connection()->prepare('DELETE FROM KurssinOpettaja '
                . 'WHERE kurssiID = :ID');
        $query->execute(array('ID' => $this->ID));

        foreach ($opettajaIDt as $opettajaID) {
            $query = DB::connection()->prepare('INSERT INTO KurssinOpettaja (kurssiID, henkiloID) VALUES (:kurssiID, :henkiloID)');
            $query->execute(array('kurssiID' => $this->ID, 'henkiloID' => $opettajaID));
        }
    }
    
    public function luo(){
        $query = DB::connection()->prepare('INSERT INTO Kurssi (kurssikoodi, nimi, kotisivu, alkamispaiva, paattymispaiva) VALUES (:kurssikoodi, :nimi, :kotisivu, :alkamispaiva, :paattymispaiva) RETURNING ID');
        $query->execute(array('kurssikoodi' => $this->kurssikoodi, 'nimi' => $this->nimi, 'kotisivu' => $this->kotisivu, 'alkamispaiva' => date('Y-m-d', $this->alkamispaiva->getTimestamp()), 'paattymispaiva' => date('Y-m-d', $this->paattymispaiva->getTimestamp())));

        $rivi = $query->fetch();
        $this->ID = $rivi['id'];
    }

}
