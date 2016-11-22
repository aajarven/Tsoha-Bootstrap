<?php

class Kysymys extends BaseModel {

    public $ID, $kyselyID, $teksti;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function kyselynKysymykset($kurssiID) {
        $query = DB::connection()->prepare('SELECT Kysymys.ID,'
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
                'kyselyID' => $kysymys['kyselyID'],
                'teksti' => $kysymys['teksti']
            ));
        }

        return $kysymykset;
    }

}
