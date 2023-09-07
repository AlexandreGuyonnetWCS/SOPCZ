<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330155553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diplome ADD diplome_full_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE diplome ADD CONSTRAINT FK_EB4C4D4ED0CAEDC4 FOREIGN KEY (diplome_full_id) REFERENCES diplome_full (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EB4C4D4ED0CAEDC4 ON diplome (diplome_full_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diplome DROP FOREIGN KEY FK_EB4C4D4ED0CAEDC4');
        $this->addSql('DROP INDEX UNIQ_EB4C4D4ED0CAEDC4 ON diplome');
        $this->addSql('ALTER TABLE diplome DROP diplome_full_id');
    }
}
