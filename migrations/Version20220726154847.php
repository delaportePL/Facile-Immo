<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726154847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre DROP etage_total, CHANGE type type VARCHAR(50) DEFAULT NULL, CHANGE superficie superficie SMALLINT DEFAULT NULL, CHANGE etage etage SMALLINT DEFAULT NULL, CHANGE piece piece SMALLINT DEFAULT NULL, CHANGE chambre chambre SMALLINT DEFAULT NULL, CHANGE garage garage TINYINT(1) DEFAULT NULL, CHANGE cave cave TINYINT(1) DEFAULT NULL, CHANGE latitude latitude DOUBLE PRECISION DEFAULT NULL, CHANGE longitude longitude DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre ADD etage_total SMALLINT NOT NULL, CHANGE type type VARCHAR(50) NOT NULL, CHANGE superficie superficie SMALLINT NOT NULL, CHANGE etage etage SMALLINT NOT NULL, CHANGE piece piece SMALLINT NOT NULL, CHANGE chambre chambre SMALLINT NOT NULL, CHANGE garage garage TINYINT(1) NOT NULL, CHANGE cave cave TINYINT(1) NOT NULL, CHANGE latitude latitude DOUBLE PRECISION NOT NULL, CHANGE longitude longitude DOUBLE PRECISION NOT NULL');
    }
}
