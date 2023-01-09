<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

#[Route('blog')]

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_list')]
    #[Template()]
    
    public function index()
    {
        return ['controller_name' => 'BlogController'];
        
    }

    #[Route("/show/{id}", name: "blog_show")]
    
    public function show($id)
    {
        dd($id);
    }
}