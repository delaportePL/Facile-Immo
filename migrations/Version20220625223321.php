<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220625223321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offre_like (id INT AUTO_INCREMENT NOT NULL, offre_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_EE31FEC74CC8505A (offre_id), INDEX IDX_EE31FEC7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_masque (id INT AUTO_INCREMENT NOT NULL, offre_id INT NOT NULL, INDEX IDX_855996804CC8505A (offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offre_like ADD CONSTRAINT FK_EE31FEC74CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE offre_like ADD CONSTRAINT FK_EE31FEC7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offre_masque ADD CONSTRAINT FK_855996804CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('DROP TABLE liked_offre');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liked_offre (id INT AUTO_INCREMENT NOT NULL, offre_id INT NOT NULL, user_id INT NOT NULL, type TINYINT(1) NOT NULL, INDEX IDX_B10388A9A76ED395 (user_id), INDEX IDX_B10388A94CC8505A (offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE liked_offre ADD CONSTRAINT FK_B10388A94CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE liked_offre ADD CONSTRAINT FK_B10388A9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE offre_like');
        $this->addSql('DROP TABLE offre_masque');
    }
}
