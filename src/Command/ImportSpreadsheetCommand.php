<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Service\PoppodiumService;
use phpDocumentor\Reflection\Types\Parent_;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

// #[AsCommand(
//     name: 'ImportSpreadsheet',
//     description: 'Add a short description for your command',
// )]
class ImportSpreadsheetCommand extends Command
{
    private $poppodiumService;
    
    public function __construct(PoppodiumService $poppodiumService) {
        parent::__construct();
        
        $this->poppodiumService = $poppodiumService;   
    }
    
    protected function configure(): void
    {
        $this
            ->setName('app:import-spreadsheet')
            ->setDescription('Import Excel Spreadsheet')
            ->setHelp('This command allows you to import a spreadsheet')
            ->addArgument('file', InputArgument::REQUIRED, 'Spreadsheet')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {    
        $inputFileName = $input->getArgument('file');
        $spreadsheet = IOFactory::load($inputFileName);

        $matrix = $spreadsheet->getSheet(0)->toArray();

        foreach($matrix as $row) {
            
            $matrix_array = [
                "naam" => $row[0],
                "adres" => $row[1],
                "postcode" => $row[2],
                "woonplaats" => $row[3],
                "telefoonnummer" => $row[4],
                "email" => $row[5],
                "website" => $row[6],
                "logo_url" => $row[7],
                "afbeelding_url" => $row[8],
            ];
        }

        $this->poppodiumService->savePodium($matrix_array);

        echo var_dump($matrix_array);

        return COMMAND::SUCCESS;
    }
}