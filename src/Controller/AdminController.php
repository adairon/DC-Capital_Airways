<?php

namespace App\Controller;

use App\Entity\Flight;
use App\Form\FlightType;
use App\Repository\FlightRepository;
use App\Service\FlightService;
use Symfony\Component\Form\FormError;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function list(FlightRepository $repo)
    {
        $flights = $repo->findAll();
        return $this->render('admin/list.html.twig', [
            'flights' => $flights
        ]);
    }

    /**
     * @Route("/admin/new", name="admin_new")
     */
    public function new(Request $request, FlightService $flightservice) 
    {
        // instance de l'entité Flight à alimenter avec le formulaire.
        $flight = new Flight();
        // on créé un formulaire basé sur la classe FlightType qui configure les champs.
        $form = $this -> createForm(FlightType::class, $flight);
        // pour gérer la soumission
        $form->handleRequest($request);

        // on vérifie que les villes d'arrivée et de départ sont différentes
        //On utilise une génération de message d'erreur mais ce test est opérationnel dans l'entité Flight

        /*if($flight->getDeparture() == $flight->getArrival()) {
            $error = new FormError("Le départ et l'arrivée doivent être différents.");
            $form->get("arrival")->addError($error);
        }*/

        //on donne un numéro de vol aléatoire
        $flight->setNumber($flightservice->getFlightNumber());

        // on enregistre les données du formulaire (aussi l'objet Flight)
        if($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($flight);
            $manager->flush();
            //quand le formulaire est soumis, on est redirigé vers la page d'accueil de l'admin
            return $this->redirectToRoute('admin_home');
        }
        return $this -> render('admin/create.html.twig', [
            'myform' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/edit/{id}", name="admin_edit")
     */
    public function edit(Request $request, $id) 
    {
        //je récupère de la base de données le vol relatif à l'identifiant $id
        $flight = $this->getDoctrine()->getRepository(Flight::class)->find($id);
        //je créé un formulaire alimenté pa l'objet Flight
        $form = $this->createForm(FlightType::class, $flight);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($flight);
            $manager->flush();
            //quand le formulaire est soumis, on est redirigé vers la page d'accueil de l'admin
            return $this->redirectToRoute('admin_home');
        }
        return $this -> render('admin/update.html.twig', [
            'numero_vol' => $flight->getNumber(),
            'flight'=>$flight,
            'myform' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="admin_delete")
     */
    public function delete(Flight $flight)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($flight);
        $manager->flush();
        return $this->redirectToRoute('admin_home');

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
