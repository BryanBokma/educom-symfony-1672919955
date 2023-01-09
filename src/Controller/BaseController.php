<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    private $logger;
    
    protected function log($msg, $type)
    {
        $this->logger->info($msg);
    }

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    } 

    #[Route('/show{id}', name: 'blog_show')]

    public function show($id = 1)
    {
        $this->log('info Message from extended BaseController');
        dd($id);
    }
    
}