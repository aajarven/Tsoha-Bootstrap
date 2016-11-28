<?php

class Kysely extends BaseModel {

    public $ID, $kurssiID, $tila, $vastaajamaara;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function opettajanKyselyt($opettajaID) {
        $query = DB::connection()->prepare('SELECT kyselyID, kurssitiedot.kurssiID, nimi, tilaID, tilannimi, vastausmaara '
                . 'FROM ('
                . 'SELECT kyselyntila.kyselyID, Kurssi.ID as kurssiID, Kurssi.nimi, kyselyntila.tilaID, kyselyntila.nimi AS tilannimi '
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
                'ID' => $kysely['kyselyid'],
                'kurssiID' => $kysely['kurssiid'],
                'tila' => $kysely['tilannimi'],
                'vastaajamaara' => $kysely['vastausmaara']
            ));
        }

        return $kyselyt;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kysely (KurssiID) VALUES (:kurssiID) RETURNING ID, status');
        $query->execute(array('kurssiID' => $this->kurssiID));
        $rivi = $query->fetch();

        $this->ID = $rivi['id'];
        $this->status = $rivi['status'];
    }

    public static function haeKurssinKysely($kurssiID) {
        $query = DB::connection()->prepare('SELECT Kysely.ID, Kysely.kurssiID, kysely.status '
                . 'FROM Kysely, Kurssi '
                . 'WHERE Kysely.kurssiID = Kurssi.ID '
                . 'AND Kurssi.ID = :ID');
        $query->execute(array('ID' => $kurssiID));

        $rivi = $query->fetch();
        $kysely = new Kysely(array(
            'ID' => $rivi['id'],
            'kurssiID' => $rivi['kurssiid'],
            'tila' => $rivi['status']
        ));
        return $kysely;
    }
    
    public static function haeKysely($kyselyID) {
        $query = DB::connection()->prepare('SELECT Kysely.ID, Kysely.kurssiID, kysely.status '
                . 'FROM Kysely '
                . 'WHERE Kysely.ID = :ID');
        $query->execute(array('ID' => $kyselyID));

        $rivi = $query->fetch();
        $kysely = new Kysely(array(
            'ID' => $rivi['id'],
            'kurssiID' => $rivi['kurssiid'],
            'tila' => $rivi['status']
        ));
        return $kysely;
    }
    
    public function poista(){
//        $kysymykset = Kysymys::kyselynKysymykset($this->$kurssiID);
//        foreach ($kysymykset as $kysymys){
//            $kysymys->poista();
//        }
        
        $query = DB::connection()->prepare('DELETE FROM Kysely '
                . 'WHERE ID = :kyselyID');
        $query->execute(array('kyselyID' => $this->ID));
    }
}
