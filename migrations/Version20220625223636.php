<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220625223636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_masque ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre_masque ADD CONSTRAINT FK_85599680A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_85599680A76ED395 ON offre_masque (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_masque DROP FOREIGN KEY FK_85599680A76ED395');
        $this->addSql('DROP INDEX IDX_85599680A76ED395 ON offre_masque');
        $this->addSql('ALTER TABLE offre_masque DROP user_id');
    }
}
