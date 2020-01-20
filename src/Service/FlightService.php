<?php

namespace App\Service;

class FlightService {

    /**
     * fonction pour créer le numéro de vol : 2 lettres et 4 chiffres aléatoires :
     * @return string
     */
    public function getFlightNumber():string
    {
        // créé un tableau avec toutes les lettres en majuscule de A à Z :
        $lettres = range('A', 'Z'); 
        // mélange les lettres aléatoirement :
        shuffle($lettres); 
        //extrait le 1er item du tableau : 
        $lettre = array_shift($lettres);
        //on recommence et on concatenne :
        shuffle($lettres);
        $lettre .= array_shift($lettres);
        // un nombre sur 4 digit au hasard :
        $nombre = mt_rand(1000,9999);
        return $lettre.$nombre;
    }

}