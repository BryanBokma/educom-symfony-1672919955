<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    private $logger;
    
    protected function log($msg, $type = "info")
    {   
        switch($type) {
            
            case "info": {
                $this->logger->info($msg);
            }

            case "warning": {
                $this->logger->warning($msg);
            }

            case "error": {
                $this->logger->error($msg);
            }
        }
    }

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    } 
    
    
    
}