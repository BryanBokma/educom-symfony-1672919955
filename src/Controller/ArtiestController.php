<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Artiest;

class ArtiestController extends AbstractController
{
    #[Route('/artiest', name: 'artiest')]
    
    public function index(): Response
    {
        // Onderstaande is simuleren $_POST request voor artiest
        $artiest = [
            "naam" => "Celine Dion",
            "genre" => "Pop",
            "omschrijving" => "Celine Dion my heart will go on, Titanic",
            "afbeelding_url" => "https://celine-dion.com",
            "website" => "https://celine-dion.com"
        ];
        
        $rep = $this->getDoctrine()->getRepository(Artiest::class);
        $result = $rep->saveArtiest($artiest);

        dd($result);
    }
}