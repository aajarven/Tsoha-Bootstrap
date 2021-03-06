<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            $errors = array_merge($errors, $this->{$validator}());
        }

        return $errors;
    }

    public function validoiEiNull($teksti, $virheilmoitus) {
        $virheet = array();
        if ($teksti == '' || $teksti == null) {
            $virheet[] = $virheilmoitus;
        }

        return $virheet;
    }
    
    public function validoiMaksimipituus($teksti, $maksimipituus, $virheilmoitus) {
        $virheet = array();
        if (strlen($teksti) > $maksimipituus) {
            $virheet[] = $virheilmoitus;
        }

        return $virheet;
    }
    
    public function validoiOnPositiivinenLuku($string, $virheilmoitus){
        $virheet = array();
        if (!is_numeric($string)){
            $virheet[] = $virheilmoitus;
        } elseif ((int)$string <= 0){
            $virheet[] = $virheilmoitus;
        }
        return $virheet;
    }

}
