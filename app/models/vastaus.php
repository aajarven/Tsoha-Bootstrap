<?php

class Vastaus extends BaseModel {
    public $opiskelijaID, $kysymysID, $vastaus;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function lisaaVastaus(){
        $query = DB::connection()->prepare('INSERT INTO Vastaus (opiskelijaID, kysymysID, vastaus) VALUES (:opiskelijaID, :kysymysID, :vastaus)');
        $query->execute(array('opiskelijaID' => $this->opiskelijaID, 'kysymysID' => $this->kysymysID, 'vastaus'=>$this->vastaus));
    }
}
