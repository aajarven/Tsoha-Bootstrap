<?php

class Tila extends BaseModel {

    public static function suurinSallittu() {
        $query = DB::connection()->prepare('SELECT MAX(ID) AS maksimi FROM Tila');
        $query->execute();
        $rivi = $query->fetch();

        return $rivi['maksimi'];
    }
    
    public static function haeTilanNimi($tilaID){
        $query = DB::connection()->prepare('SELECT nimi FROM Tila WHERE ID=:ID');
        $query->execute(array('ID' => $tilaID));
        $rivi = $query->fetch();

        return $rivi['nimi'];
    }

}
