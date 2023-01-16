<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

#[AsCommand(
    name: 'ImportSpreadsheet',
    description: 'Add a short description for your command',
)]
class ImportSpreadsheetCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('app:import-spreadsheet')
            ->setDescription('Import Excel Spreadsheet')
            ->setHelp('This command allows you to import a spreadsheet')
            ->addArgument('naam', InputArgument::REQUIRED, 'naam')
            ->addArgument('adres', InputArgument::REQUIRED, 'adres')
            ->addArgument('postcode', InputArgument::REQUIRED, 'postcode')
            ->addArgument('woonplaats', InputArgument::REQUIRED, 'woonplaats')
            ->addArgument('telefoonnummer', InputArgument::REQUIRED, 'telefoonnummer')
            ->addArgument('email', InputArgument::REQUIRED, 'email')
            ->addArgument('website', InputArgument::REQUIRED, 'website')
            ->addArgument('logo_url', InputArgument::REQUIRED, 'logo_url')
            ->addArgument('afbeelding_url', InputArgument::REQUIRED, 'afbeelding_url')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = [
            "naam" => $input->getArgument('naam'),
            "adres" => $input->getArgument('adres'),
            "postcode" => $input->getArgument('postcocde'),
            "woonplaats" => $input->getArgument('woonplaats'),
            "telefoonnummer" => $input->getArgument('telefoonnummer'),
            "email" => $input->getArgument('email'),
            "website" => $input->getArgument('website'),
            "logo_url" => $input->getArgument('logo_url'),
            "afbeelding_url" => $input->getArgument('afbeelding_url')
        ];
        $spreadsheet = IOFactory::load($inputFileName);

        return COMMAND::SUCCESS;
    }
}