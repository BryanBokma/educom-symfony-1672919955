<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Locale;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

//Serializer 
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Entity\Optreden;

#[Route('/homepage')]

class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    // #[Template()]
    
    public function index()
    {
        $rep = $this->getDoctrine()->getRepository(Optreden::class);
        $data = $rep->getAllOptredens();
        
        dump($data);
        die();
        
        // return ['controller_name' => 'HomepageController'];
    }
    
    #[Route("/backhome", name:"backhome")]
    
    public function backhome()
    {
        return $this->redirectToRoute('homepage');
    }

    // #[Route(path: [
    //     'en' => 'contact-us',
    //     'nl' => 'neem-contact-op'
    // ], name: 'contact')]

    /**
    * @Route({
    *     "en": "/contact-us",
    *     "nl": "/neem-contact-op"
    * }, name="contact")
    */

    public function contact(Request $request)
    {
        $locale = $request->getLocale();
        $msg = "This page is in English";
        if($locale == "nl") 
        {
            $msg = "Deze pagina is in het Nederlands";
        }
        return new Response("<html><body>$msg</body></html>"); 
    }

    #[Route('/optredens.{_format}', name: 'optredens_output', requirements: ['_format' => 'xml|json'])]
    
    public function ophalenOptredens($_format)
    {
        $rep = $this->getDoctrine()->getRepository(Optreden::class);
        $data = $rep->getAllOptredens();
        
        if($_format == 'json') {
            return($this->json($data, context: [
                ObjectNormalizer::IGNORED_ATTRIBUTES => ['__cloner__', '__initializer__'],
                ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function($object) {
                    return $object->getId();
                }
            ]));
        } else {
        return $this->render('homepage/test.xml.twig', [
            'data' => $data,
        ]);

        }
    }

    #[Route("/save-data", name: "homepage_save_data")]

    public function saveData(Request $request) {
        $params = $request->request->all();
        dd($params);
    }

    // #[Route('/optredens', name: 'data_optredens')]

    // public function ophalenOptredens() 
    // {
    //     $encoders = [new XmlEncoder(), new JsonEncoder()];
    //     $normalizers = [new ObjectNormalizer()];
    //     $serializer = new Serializer($normalizers, $encoders);
        
    //     $rep = $this->getDoctrine()->getRepository(Optreden::class);
    //     $data = $rep->getAllOptredens();

    //     $jsonContent = $serializer->serialize($data, 'json');
        
    //     dump($jsonContent);
    // }
}