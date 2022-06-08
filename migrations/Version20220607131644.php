<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607131644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liked_offre DROP FOREIGN KEY FK_B10388A94CC8505A');
        $this->addSql('CREATE TABLE liked_offer (id INT AUTO_INCREMENT NOT NULL, offer_id INT NOT NULL, user_id INT NOT NULL, type TINYINT(1) NOT NULL, INDEX IDX_375389F853C674EE (offer_id), INDEX IDX_375389F8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, prix INT NOT NULL, type VARCHAR(50) NOT NULL, superficie SMALLINT NOT NULL, etage SMALLINT NOT NULL, etage_total SMALLINT NOT NULL, piece SMALLINT NOT NULL, chambre SMALLINT NOT NULL, salle_de_bain SMALLINT NOT NULL, toilette SMALLINT NOT NULL, terrain SMALLINT NOT NULL, terrasse INT NOT NULL, balcon INT NOT NULL, garage TINYINT(1) NOT NULL, cave TINYINT(1) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liked_offer ADD CONSTRAINT FK_375389F853C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE liked_offer ADD CONSTRAINT FK_375389F8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE liked_offre');
        $this->addSql('DROP TABLE offre');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liked_offer DROP FOREIGN KEY FK_375389F853C674EE');
        $this->addSql('CREATE TABLE liked_offre (id INT AUTO_INCREMENT NOT NULL, offre_id INT NOT NULL, user_id INT NOT NULL, type TINYINT(1) NOT NULL, INDEX IDX_B10388A94CC8505A (offre_id), INDEX IDX_B10388A9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, prix INT NOT NULL, type VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, superficie SMALLINT NOT NULL, etage SMALLINT NOT NULL, etage_total SMALLINT NOT NULL, piece SMALLINT NOT NULL, chambre SMALLINT NOT NULL, salle_de_bain SMALLINT NOT NULL, toilette SMALLINT NOT NULL, terrain SMALLINT NOT NULL, terrasse INT NOT NULL, balcon INT NOT NULL, garage TINYINT(1) NOT NULL, cave TINYINT(1) NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE liked_offre ADD CONSTRAINT FK_B10388A94CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE liked_offre ADD CONSTRAINT FK_B10388A9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE liked_offer');
        $this->addSql('DROP TABLE offer');
    }
}
