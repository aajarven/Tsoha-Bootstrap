<?php

class OpiskelijanakymaController extends BaseController{
    public static function opiskelijanakyma($id){
        $kurssit = Kurssi::opiskelijanKurssit($id);
        View::make('opiskelijanakyma.html', array('kurssit' => $kurssit));
    }
}

