<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726162930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_image DROP FOREIGN KEY FK_9217E3C43DA5256D');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE offre_image');
        $this->addSql('ALTER TABLE offre ADD image_2 LONGBLOB DEFAULT NULL, ADD image_3 LONGBLOB DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE offre_image (offre_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_9217E3C44CC8505A (offre_id), INDEX IDX_9217E3C43DA5256D (image_id), PRIMARY KEY(offre_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE offre_image ADD CONSTRAINT FK_9217E3C43DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_image ADD CONSTRAINT FK_9217E3C44CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre DROP image_2, DROP image_3');
    }
}
