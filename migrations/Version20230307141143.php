<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307141143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE base_autorisation (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE base_autorisation_diplome (base_autorisation_id INT NOT NULL, diplome_id INT NOT NULL, INDEX IDX_B1AA55673171B15F (base_autorisation_id), INDEX IDX_B1AA556726F859E2 (diplome_id), PRIMARY KEY(base_autorisation_id, diplome_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE base_autorisation_centre (base_autorisation_id INT NOT NULL, centre_id INT NOT NULL, INDEX IDX_2567D88B3171B15F (base_autorisation_id), INDEX IDX_2567D88B463CD7C3 (centre_id), PRIMARY KEY(base_autorisation_id, centre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE base_autorisation_employe (base_autorisation_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_A2E2CB903171B15F (base_autorisation_id), INDEX IDX_A2E2CB901B65292 (employe_id), PRIMARY KEY(base_autorisation_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplome (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, categorie VARCHAR(255) DEFAULT NULL, validite VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, template VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, departement VARCHAR(255) DEFAULT NULL, poste VARCHAR(255) DEFAULT NULL, amco DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', photo VARCHAR(255) DEFAULT NULL, genre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, nom_directeur VARCHAR(255) DEFAULT NULL, prenom_directeur VARCHAR(255) DEFAULT NULL, signature_directeur VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, contacte VARCHAR(255) DEFAULT NULL, genre_directeur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE base_autorisation_diplome ADD CONSTRAINT FK_B1AA55673171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_diplome ADD CONSTRAINT FK_B1AA556726F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_centre ADD CONSTRAINT FK_2567D88B3171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_centre ADD CONSTRAINT FK_2567D88B463CD7C3 FOREIGN KEY (centre_id) REFERENCES centre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_employe ADD CONSTRAINT FK_A2E2CB903171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_employe ADD CONSTRAINT FK_A2E2CB901B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base_autorisation_diplome DROP FOREIGN KEY FK_B1AA55673171B15F');
        $this->addSql('ALTER TABLE base_autorisation_diplome DROP FOREIGN KEY FK_B1AA556726F859E2');
        $this->addSql('ALTER TABLE base_autorisation_centre DROP FOREIGN KEY FK_2567D88B3171B15F');
        $this->addSql('ALTER TABLE base_autorisation_centre DROP FOREIGN KEY FK_2567D88B463CD7C3');
        $this->addSql('ALTER TABLE base_autorisation_employe DROP FOREIGN KEY FK_A2E2CB903171B15F');
        $this->addSql('ALTER TABLE base_autorisation_employe DROP FOREIGN KEY FK_A2E2CB901B65292');
        $this->addSql('DROP TABLE base_autorisation');
        $this->addSql('DROP TABLE base_autorisation_diplome');
        $this->addSql('DROP TABLE base_autorisation_centre');
        $this->addSql('DROP TABLE base_autorisation_employe');
        $this->addSql('DROP TABLE centre');
        $this->addSql('DROP TABLE diplome');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE user');
    }
}
