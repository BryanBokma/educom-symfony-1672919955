<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Optreden;

#[Route("/optreden")]

class OptredenController extends AbstractController
{
    #[Route('/optreden', name: 'optreden')]
    
    public function index(): Response
    {
        return $this->render('optreden/index.html.twig', [
            'controller_name' => 'OptredenController',
        ]);
    }

    #[Route('/save', name: 'optreden_save')]
    public function saveOptreden() {
        
        $rep = $this->getDoctrine()->getRepository(Optreden::class);
        
        //Simulatie van een $_POST request
        $optreden = [
            "poppodium_id" => 1,
            "hoofdprogramma_id" => 1, 
            "voorprogramma_id" => 2,
            "omschrijving" => "Een avondje blues uit het boekje...",
            "datum" => "2022-07-14",
            
            // Prijs altijd in centen, ivm afronding
            "prijs" => 3800,
            
            "ticket_url" => "https://melkweg.nl/ticket/",
            "afbeelding_url" => "https://melkweg.nl/optreden/plaatje.jpg"
        ];
        
        $result = $rep->saveOptreden($optreden);
        dd($result);
        
    }

}