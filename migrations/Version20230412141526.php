<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230412141526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE base_autorisation_diplome_full (base_autorisation_id INT NOT NULL, diplome_full_id INT NOT NULL, INDEX IDX_43AAB7393171B15F (base_autorisation_id), INDEX IDX_43AAB739D0CAEDC4 (diplome_full_id), PRIMARY KEY(base_autorisation_id, diplome_full_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE base_autorisation_diplome_full ADD CONSTRAINT FK_43AAB7393171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_diplome_full ADD CONSTRAINT FK_43AAB739D0CAEDC4 FOREIGN KEY (diplome_full_id) REFERENCES diplome_full (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base_autorisation_diplome_full DROP FOREIGN KEY FK_43AAB7393171B15F');
        $this->addSql('ALTER TABLE base_autorisation_diplome_full DROP FOREIGN KEY FK_43AAB739D0CAEDC4');
        $this->addSql('DROP TABLE base_autorisation_diplome_full');
    }
}
