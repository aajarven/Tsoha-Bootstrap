<?php

class Kysely extends BaseModel {

    public $kurssiID, $tila, $vastaajamaara;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function opettajanKyselyt($opettajaID) {
        $query = DB::connection()->prepare('SELECT kurssitiedot.kurssiID, nimi, tilaID, tilannimi, vastausmaara '
                . 'FROM ('
                . 'SELECT Kurssi.ID as kurssiID, Kurssi.nimi, kyselyntila.tilaID, kyselyntila.nimi AS tilannimi '
                . 'FROM Kurssi '
                . 'LEFT OUTER JOIN ('
                . 'SELECT Kysely.ID as kyselyID, Tila.ID as tilaID, Tila.nimi '
                . 'FROM Kysely, Tila WHERE Kysely.status = Tila.ID) AS kyselyntila '
                . 'ON Kurssi.ID = kyselyntila.kyselyID '
                . 'ORDER BY tilaID, kurssiID) AS kurssitiedot,'
                . '(SELECT ID, COALESCE(vastausmaara, 0) as vastausmaara '
                . 'FROM( SELECT Kysely.ID, vastausmaara '
                . 'FROM Kysely LEFT JOIN '
                . '(SELECT KyselyID, COUNT(DISTINCT OpiskelijaID) AS vastausmaara '
                . 'FROM Vastaus, Kysely, Kysymys '
                . 'WHERE Kysymys.kyselyID = Kysely.ID '
                . 'AND Vastaus.kysymysID = Kysymys.ID '
                . 'GROUP BY kyselyID) AS testi '
                . 'ON testi.kyselyID = Kysely.ID) AS maaratnulleilla) AS maaratiedot, '
                . 'KurssinOpettaja '
                . 'WHERE Kurssitiedot.kurssiID = maaratiedot.ID '
                . 'AND KurssinOpettaja.kurssiID = Kurssitiedot.kurssiID '
                . 'AND KurssinOpettaja.henkiloID =:ID '
                . 'ORDER BY tilaID, kurssiID');
        $query->execute(array('ID' => $opettajaID));
        $rivit = $query->fetchAll();

        $kyselyt = array();

        foreach ($rivit as $kysely) {
            $kyselyt[] = new Kysely(array(
                'kurssiID' => $kysely['kurssiid'],
                'tila' => $kysely['tilannimi'],
                'vastaajamaara' => $kysely['vastausmaara']
            ));
        }

        return $kyselyt;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kysely (KurssiID) VALUES (:kurssiID)');
        $query->execute(array('kurssiID' => $this->kurssiID));
        $rivi = $query->fetch();
    }

}
