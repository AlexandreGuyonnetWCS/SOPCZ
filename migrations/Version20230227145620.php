<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227145620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_base_autorisation DROP FOREIGN KEY FK_5FC6160B3171B15F');
        $this->addSql('ALTER TABLE carte_base_autorisation DROP FOREIGN KEY FK_5FC6160BC9C7CEB6');
        $this->addSql('ALTER TABLE carte DROP FOREIGN KEY FK_BAD4FFFDA4AEAFEA');
        $this->addSql('DROP TABLE carte_base_autorisation');
        $this->addSql('DROP TABLE carte');
        $this->addSql('ALTER TABLE diplome ADD template VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte_base_autorisation (carte_id INT NOT NULL, base_autorisation_id INT NOT NULL, INDEX IDX_5FC6160B3171B15F (base_autorisation_id), INDEX IDX_5FC6160BC9C7CEB6 (carte_id), PRIMARY KEY(carte_id, base_autorisation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE carte (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_BAD4FFFDA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE carte_base_autorisation ADD CONSTRAINT FK_5FC6160B3171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carte_base_autorisation ADD CONSTRAINT FK_5FC6160BC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carte ADD CONSTRAINT FK_BAD4FFFDA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE diplome DROP template');
    }
}
