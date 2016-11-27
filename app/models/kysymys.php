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
                'id' => $kysymys['id'],
                'kyselyID' => $kysymys['kyselyid'],
                'teksti' => $kysymys['teksti']
            ));
        }

        return $kysymykset;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Kysymys (kyselyID, teksti) VALUES (:kyselyID, :teksti) RETURNING ID');
        $query->execute(array('kyselyID' => $this->kyselyID, 'teksti' => $this->teksti));
        
        $rivi = $query->fetch();
        $this->ID = $rivi['id'];
    }
    
    public function validoiTeksti(){
        return $this->{'validoiEiNull'}($this->teksti, "Kysymys ei voi olla tyhjä");
    }

}
