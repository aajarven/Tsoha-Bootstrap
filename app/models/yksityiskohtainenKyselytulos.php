<?php

class YksityiskohtainenKyselytulos extends BaseModel{
    
    public $numeeriset, $monivalinnat, $avoimet;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public function kyselytulos($kurssiID){
        // numeeriset monivalinnat
        $query = DB::connection()->prepare('SELECT Kysymys.ID, '
                . 'Kysymys.teksti, '
                . ''
                . 'FROM Monivalintavastaus, Monivalintavaihtoehto, Kysymys, Kysely '
                . 'WHERE (Kysely.ID = Kysymys.KyselyID OR Kysymys.OrganisaatioID = Kurssi.organisaatioID) '
                . 'AND Monivalintavaihtoehto.kysymysID = Kysymys.ID '
                . 'AND Monivalintavastaus.kysymysID = Kysymys.ID '
                . 'AND Monivalintavastaus.jarjestysluku = Monivalintavaihtoehto.jarjestysluku')
    }
}
