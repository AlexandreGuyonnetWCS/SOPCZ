<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330151835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE diplome_categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplome_full (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, name_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, INDEX IDX_F7ED9CF0C54C8C93 (type_id), INDEX IDX_F7ED9CF071179CD6 (name_id), INDEX IDX_F7ED9CF0BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplome_nom (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplome_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diplome_full ADD CONSTRAINT FK_F7ED9CF0C54C8C93 FOREIGN KEY (type_id) REFERENCES diplome_type (id)');
        $this->addSql('ALTER TABLE diplome_full ADD CONSTRAINT FK_F7ED9CF071179CD6 FOREIGN KEY (name_id) REFERENCES diplome_nom (id)');
        $this->addSql('ALTER TABLE diplome_full ADD CONSTRAINT FK_F7ED9CF0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES diplome_categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diplome_full DROP FOREIGN KEY FK_F7ED9CF0C54C8C93');
        $this->addSql('ALTER TABLE diplome_full DROP FOREIGN KEY FK_F7ED9CF071179CD6');
        $this->addSql('ALTER TABLE diplome_full DROP FOREIGN KEY FK_F7ED9CF0BCF5E72D');
        $this->addSql('DROP TABLE diplome_categorie');
        $this->addSql('DROP TABLE diplome_full');
        $this->addSql('DROP TABLE diplome_nom');
        $this->addSql('DROP TABLE diplome_type');
    }
}
