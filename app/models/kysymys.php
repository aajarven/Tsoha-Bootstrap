<?php

class Kysymys extends BaseModel {

    public $ID, $kyselyID, $teksti;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoiTeksti');
    }

    public static function kyselynKysymykset($kurssiID) {
        $query = DB::connection()->prepare('SELECT Kysymys.ID,'
                . 'Kysymys.kyselyID, '
                . 'Kysymys.teksti '
                . 'FROM Kysymys, Kysely '
                . 'WHERE Kysymys.kyselyID = Kysely.ID '
                . 'AND Kysely.kurssiID = :ID');
        $query->execute(array('ID' => $kurssiID));
        $rivit = $query->fetchAll();

        $kysymykset = array();

        foreach ($rivit as $kysymys) {
            $kysymykset[] = new Kysymys(array(
                'ID' => $kysymys['id'],
                'kyselyID' => $kysymys['kyselyid'],
                'teksti' => $kysymys['teksti']
            ));
        }

        return $kysymykset;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kysymys (kyselyID, teksti) VALUES (:kyselyID, :teksti) RETURNING ID');
        $query->execute(array('kyselyID' => $this->kyselyID, 'teksti' => $this->teksti));

        $rivi = $query->fetch();
        $this->ID = $rivi['id'];
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Kysymys '
                . 'SET teksti = :teksti '
                . 'WHERE ID = :kysymysID');
        $query->execute(array('kysymysID' => $this->ID, 'teksti' => $this->teksti));
    }
    
    public function poista(){
        $query = DB::connection()->prepare('DELETE FROM Kysymys '
                . 'WHERE ID = :kysymysID');
        $query->execute(array('kysymysID' => $this->ID));
    }

    public function validoiTeksti() {
        $virheet = $this->{'validoiEiNull'}($this->teksti, "Kysymys ei voi olla tyhjä");
        $virheet = array_merge($virheet, $this->{'validoiMaksimipituus'}($this->teksti, 500, "Kysymyksen maksimipituus on 500 merkkiä"));
        return $virheet;
    }

    public function haeKysymys($kysymysID) {
        $query = DB::connection()->prepare('SELECT Kysymys.ID,'
                . 'Kysymys.kyselyID, '
                . 'Kysymys.teksti '
                . 'FROM Kysymys '
                . 'WHERE Kysymys.ID = :ID');
        $query->execute(array('ID' => $kysymysID));
        $rivi = $query->fetch();


        $kysymys = new Kysymys(array(
            'ID' => $rivi['id'],
            'kyselyID' => $rivi['kyselyid'],
            'teksti' => $rivi['teksti']
        ));

        return $kysymys;
    }
    
}
