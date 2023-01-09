<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Psr\Log\LoggerInterface;

#[Route('blog')]

class BlogController extends BaseController
{
    #[Route('/{page}', name: 'blog_list', requirements: ['page' => '/d+'])]
    #[Template()]
    
    public function list($page)
    {
        return ['controller_name' => 'BlogController'];
    }

    #[Route('/{slug}', name: 'blog_show')]
    
    public function show(LoggerInterface $logger, $slug)
    {
        $logger->info('info Message');
        $logger->warning('Warning Message');
        $logger->error('De waarde van id is: $slug');
        
        dd($slug);
    }

    
}