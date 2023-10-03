<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002084120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE base_autorisation (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE base_autorisation_centre (base_autorisation_id INT NOT NULL, centre_id INT NOT NULL, INDEX IDX_2567D88B3171B15F (base_autorisation_id), INDEX IDX_2567D88B463CD7C3 (centre_id), PRIMARY KEY(base_autorisation_id, centre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE base_autorisation_employe (base_autorisation_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_A2E2CB903171B15F (base_autorisation_id), INDEX IDX_A2E2CB901B65292 (employe_id), PRIMARY KEY(base_autorisation_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE base_autorisation_diplome_full (base_autorisation_id INT NOT NULL, diplome_full_id INT NOT NULL, INDEX IDX_43AAB7393171B15F (base_autorisation_id), INDEX IDX_43AAB739D0CAEDC4 (diplome_full_id), PRIMARY KEY(base_autorisation_id, diplome_full_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplome_full (id INT AUTO_INCREMENT NOT NULL, validite INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, diplome_type VARCHAR(255) DEFAULT NULL, diplome_name VARCHAR(255) DEFAULT NULL, diplome_category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_D8698A761B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, departement VARCHAR(255) DEFAULT NULL, poste VARCHAR(255) DEFAULT NULL, amco DATETIME DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, genre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, nom_directeur VARCHAR(255) DEFAULT NULL, prenom_directeur VARCHAR(255) DEFAULT NULL, signature_directeur VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, contacte VARCHAR(255) DEFAULT NULL, genre_directeur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE numero_habilitation (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_AC2847461B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE numero_habilitation_centre (numero_habilitation_id INT NOT NULL, centre_id INT NOT NULL, INDEX IDX_FC19B51998DB45D6 (numero_habilitation_id), INDEX IDX_FC19B519463CD7C3 (centre_id), PRIMARY KEY(numero_habilitation_id, centre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, email_token VARCHAR(255) DEFAULT NULL, departement JSON DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE base_autorisation_centre ADD CONSTRAINT FK_2567D88B3171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_centre ADD CONSTRAINT FK_2567D88B463CD7C3 FOREIGN KEY (centre_id) REFERENCES centre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_employe ADD CONSTRAINT FK_A2E2CB903171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_employe ADD CONSTRAINT FK_A2E2CB901B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_diplome_full ADD CONSTRAINT FK_43AAB7393171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_diplome_full ADD CONSTRAINT FK_43AAB739D0CAEDC4 FOREIGN KEY (diplome_full_id) REFERENCES diplome_full (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A761B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE numero_habilitation ADD CONSTRAINT FK_AC2847461B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE numero_habilitation_centre ADD CONSTRAINT FK_FC19B51998DB45D6 FOREIGN KEY (numero_habilitation_id) REFERENCES numero_habilitation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE numero_habilitation_centre ADD CONSTRAINT FK_FC19B519463CD7C3 FOREIGN KEY (centre_id) REFERENCES centre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base_autorisation_centre DROP FOREIGN KEY FK_2567D88B3171B15F');
        $this->addSql('ALTER TABLE base_autorisation_centre DROP FOREIGN KEY FK_2567D88B463CD7C3');
        $this->addSql('ALTER TABLE base_autorisation_employe DROP FOREIGN KEY FK_A2E2CB903171B15F');
        $this->addSql('ALTER TABLE base_autorisation_employe DROP FOREIGN KEY FK_A2E2CB901B65292');
        $this->addSql('ALTER TABLE base_autorisation_diplome_full DROP FOREIGN KEY FK_43AAB7393171B15F');
        $this->addSql('ALTER TABLE base_autorisation_diplome_full DROP FOREIGN KEY FK_43AAB739D0CAEDC4');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A761B65292');
        $this->addSql('ALTER TABLE numero_habilitation DROP FOREIGN KEY FK_AC2847461B65292');
        $this->addSql('ALTER TABLE numero_habilitation_centre DROP FOREIGN KEY FK_FC19B51998DB45D6');
        $this->addSql('ALTER TABLE numero_habilitation_centre DROP FOREIGN KEY FK_FC19B519463CD7C3');
        $this->addSql('DROP TABLE base_autorisation');
        $this->addSql('DROP TABLE base_autorisation_centre');
        $this->addSql('DROP TABLE base_autorisation_employe');
        $this->addSql('DROP TABLE base_autorisation_diplome_full');
        $this->addSql('DROP TABLE centre');
        $this->addSql('DROP TABLE diplome_full');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE numero_habilitation');
        $this->addSql('DROP TABLE numero_habilitation_centre');
        $this->addSql('DROP TABLE user');
    }
}
