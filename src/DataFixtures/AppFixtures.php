<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Flight;
use App\Service\FlightService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    private $flightservice;

    function __construct(FlightService $flightservice)
    {
        $this->flightservice = $flightservice;
    }

    public function load(ObjectManager $manager)
    {
        // --alimenter la table City en utilisant l'entité City :
        //On créé un tableau avec les villes :
        $cities = ['Londres', 'Paris', 'Berlin', 'Lisbonne', 'Madrid','Bruxelles', 'Rome'];
        $tabObjCity=[];
        //on boucle pour chaque ville du tableau, on alimente un tableau d'objet avec les noms et on enregistre dans la BDD persist puis flush
        foreach ($cities as $name){
            $city = new City();
            $city -> setName($name);
            $tabObjCity[]=$city;
            $manager -> persist($city);
        }

        $flight = new Flight();
        $flight 
            //on attribue le numéro de vol avec la fonction créée :
            -> setNumber($this->flightservice->getFlightNumber())
            // horaire uniquement en format hh:mm
            -> setSchedule(\DateTime::createFromFormat('H:i', '08:00'))
            -> setSeat(28)
            -> setPrice(210)
            -> setReduction(false)
            -> setDeparture($tabObjCity[0])
            -> setArrival($tabObjCity[4]);
        $manager -> persist($flight);

        $manager->flush();
    }
    
    /**
     * fonction pour créer le numéro de vol : 2 lettres et 4 chiffres aléatoires :
     * @return string
     */
    // public function getFlightNumber():string{
    //     // créé un tableau avec toutes les lettres en majuscule de A à Z :
    //     $lettres = range('A', 'Z'); 
    //     // mélange les lettres aléatoirement :
    //     shuffle($lettres); 
    //     //extrait le 1er item du tableau : 
    //     $lettre = array_shift($lettres);
    //     //on recommence et on concatenne :
    //     shuffle($lettres);
    //     $lettre .= array_shift($lettres);
    //     // un nombre sur 4 digit au hasard :
    //     $nombre = mt_rand(1000,9999);
    //     return $lettre.$nombre;
    // }
}
