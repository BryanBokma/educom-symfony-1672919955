<?php

namespace App\Repository;

use App\Entity\Optreden;

use App\Entity\Artiest;
use App\Entity\Poppodium;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Optreden|null find($id, $lockMode = null, $lockVersion = null)
 * @method Optreden|null findOneBy(array $criteria, array $orderBy = null)
 * @method Optreden[]    findAll()
 * @method Optreden[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptredenRepository extends ServiceEntityRepository
{
    //Hierbij definieer je de private variabelen artiest en poppodium repository's
    private $artiestRepository;
    private $poppodiumRepository;
    
    // In de construct maak je verbinding met de desbetreffende repositories, zodra de class aangeroepen word
    // Vervolgens maak je gebruik van bovenstaande private variable en daarbij zeg je = gelijk aan de functie getrepository van artiest/poppodium ophalen
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Optreden::class);
        $this->artiestRepository = $this->_em->getRepository(Artiest::class);
        $this->poppodiumRepository = $this->_em->getRepository(Poppodium::class);
    }

    //Met deze functie haal je alle data op van Optredens
    public function getAllOptredens() 
    {
        $optredens = $this->findAll();
        return($optredens);
    }

    //Je definieerd een variable, binnen de variable roep je de functie fetchArtiest aan met het desbetreffende id, binnen je artiest Repository.
    //Vervolgens return je de variable artiest omdat je die daarboven hebt gedefinieerd om de functie op te halen
    //De functie kun je vervolgens gebruiken/aanroepen in de public functie
    private function fetchArtiest($id) {
        $artiest = $this->artiestRepository->fetchArtiest($id);
        return($artiest);
    }

    //idem als artiest
    private function fetchPoppodium($id) {
        $podium = $this->poppodiumRepository->fetchPoppodium($id);
        return($podium);
    }

    //Public function saveOptreden met bijbehorende variable
    public function saveOptreden($params) {
        
        if(isset($params["id"]) && $params["id"] != "") {
            $optreden = $this->find($params["id"]);
        } else {
            //hiermee maak je een nieuw record aan 
            $optreden = new Optreden();
        }

        //De variable optreden defenieer je als de functie setPodium, die vervolgens de private functie die je van tevoren hebt gedefinieerd runt en daaruit het poppodium_id pakt
        //Idem setArtiest
        $optreden->setPodium($this->fetchPoppodium($params["poppodium_id"]));
        $optreden->setArtiest($this->fetchArtiest($params["hoofdprogramma_id"]));

        //Als de variable params met voorpogramma_id word opgehaald dan desbetreffende artiest ok ophalen d.m.v. de functie
        if(isset($params["voorprogramma_id"])) {
            $optreden->setVoorprogramma($this->fetchArtiest($params["voorprogramma_id"]));
        }
        //Dit zijn de sets die je aanroept/definieerd vanuit optreden.php, vergelijkbaar met ingredienten/gerecht in verrukkulluk
        $optreden->setOmschrijving($params["omschrijving"]);
        $optreden->setDatum(new \DateTime($params["datum"]));

        $optreden->setPrijs($params["prijs"]);
        $optreden->setTicketUrl($params["ticket_url"]);
        $optreden->setAfbeeldingUrl($params["afbeelding_url"]);

        //hierbij maak je gebruik van de entity manager zodat je daadwerkelijk ook gegevens kunt wegschrijven in de database
        //persist bepaalt of er gegevens gewijzigd moeten worden
        //flush slaat de gegevens op in de database
        $this->_em->persist($optreden);
        $this->_em->flush();

        //je returned de variable optreden naar de aanroepende controller functie
        return($optreden);
        
    }
    
}