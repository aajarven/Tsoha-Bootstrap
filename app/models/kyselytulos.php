<?php

class Kyselytulos extends BaseModel {

    public $kysymys, $ykkoset, $kakkoset, $kolmoset, $neloset, $vitoset, $eos;

    public static function haeTulosKysymykselle($kysymysID) {
        $query = DB::connection()->prepare('SELECT COUNT(*) AS maara, vastaus, teksti '
                . 'FROM Vastaus, Kysymys '
                . 'WHERE kysymysID = :ID '
                . 'AND kysymysID =  ID '
                . 'GROUP BY vastaus, teksti '
                . 'ORDER BY vastaus ASC');
        $query->execute(array('ID' => $kysymysID));
        $rivit = $query->fetchAll();

        $tulokset = array('kysymys' => $rivit[0]['teksti'],
            'ykkoset' => 0,
            'kakkoset' => 0,
            'kolmoset' => 0,
            'neloset' => 0,
            'vitoset' => 0,
            'eos' => 0,
        );
        
        foreach ($rivit as $rivi){
            switch ($rivi['vastaus']) {
                case 0:
                    $avain = 'eos';
                    break;
                case 1:
                    $avain = 'ykkoset';
                    break;
                case 2:
                    $avain = 'kakkoset';
                    break;
                case 3:
                    $avain = 'kolmoset';
                    break;
                case 4:
                    $avain = 'neloset';
                    break;
                case 5:
                    $avain = 'vitoset';
                    break;
            }
            
            $tulokset[$avain] = $rivi['maara'];
        }

        $tulos = new Kyselytulos($tulokset);
        return $tulos;
    }

}
