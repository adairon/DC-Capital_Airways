<?php

namespace App\Controller;

use App\Repository\FlightRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(FlightRepository $repo)
    {
        $flights = $repo->findAll();
        // dump($flights);

        return $this->render('main/index.html.twig', [
            'flights' => $flights
        ]);
    }
}
