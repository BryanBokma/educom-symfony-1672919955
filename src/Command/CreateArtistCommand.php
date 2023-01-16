<?php

namespace App\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Service\ArtiestService;
use phpDocumentor\Reflection\Types\Parent_;

class CreateArtistCommand extends Command
{
    private $artiestService;
    
    public function __construct(ArtiestService $artiestService) {
        parent::__construct();
        
        $this->artiestService = $artiestService;   
    }
    
    protected function configure(): void
    {
        $this
            ->setName("app:artist:create")
            ->addArgument('naam', InputArgument::REQUIRED, 'naam')
            ->addArgument('genre', InputArgument::REQUIRED, 'genre')
            ->addArgument('omschrijving', InputArgument::REQUIRED, 'omschrijving')
            ->addArgument('afbeelding_url', InputArgument::REQUIRED, 'afbeelding_url')
            ->addArgument('website', InputArgument::REQUIRED, 'website')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $data = [
            "naam" => $input->getArgument('naam'),
            "genre" => $input->getArgument('genre'),
            "omschrijving" => $input->getArgument('omschrijving'),
            "afbeelding_url" => $input->getArgument('afbeelding_url'),
            "website" => $input->getArgument('website')
        ];

        $this->artiestService->saveArtiest($data);

        return Command::SUCCESS;
    }
}