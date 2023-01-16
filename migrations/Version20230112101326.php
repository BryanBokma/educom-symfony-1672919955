<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112101326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE optreden CHANGE voorprogramma_id voorprogramma_id INT NOT NULL, CHANGE omschrijving omschrijving VARCHAR(50) NOT NULL, CHANGE datum datum DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE optreden CHANGE voorprogramma_id voorprogramma_id INT DEFAULT NULL, CHANGE omschrijving omschrijving TEXT NOT NULL, CHANGE datum datum VARCHAR(50) DEFAULT NULL');
    }
}