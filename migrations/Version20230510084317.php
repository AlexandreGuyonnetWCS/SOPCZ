<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510084317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diplome_full DROP FOREIGN KEY FK_F7ED9CF0BCF5E72D');
        $this->addSql('ALTER TABLE diplome_full DROP FOREIGN KEY FK_F7ED9CF0C54C8C93');
        $this->addSql('ALTER TABLE diplome_full DROP FOREIGN KEY FK_F7ED9CF071179CD6');
        $this->addSql('CREATE TABLE numero_habilitation (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_AC2847461B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE numero_habilitation_centre (numero_habilitation_id INT NOT NULL, centre_id INT NOT NULL, INDEX IDX_FC19B51998DB45D6 (numero_habilitation_id), INDEX IDX_FC19B519463CD7C3 (centre_id), PRIMARY KEY(numero_habilitation_id, centre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE numero_habilitation ADD CONSTRAINT FK_AC2847461B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE numero_habilitation_centre ADD CONSTRAINT FK_FC19B51998DB45D6 FOREIGN KEY (numero_habilitation_id) REFERENCES numero_habilitation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE numero_habilitation_centre ADD CONSTRAINT FK_FC19B519463CD7C3 FOREIGN KEY (centre_id) REFERENCES centre (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE diplome_categorie');
        $this->addSql('DROP TABLE diplome_type');
        $this->addSql('DROP TABLE diplome_nom');
        $this->addSql('ALTER TABLE diplome_full DROP FOREIGN KEY FK_F7ED9CF03171B15F');
        $this->addSql('DROP INDEX IDX_F7ED9CF0C54C8C93 ON diplome_full');
        $this->addSql('DROP INDEX IDX_F7ED9CF071179CD6 ON diplome_full');
        $this->addSql('DROP INDEX IDX_F7ED9CF0BCF5E72D ON diplome_full');
        $this->addSql('DROP INDEX IDX_F7ED9CF03171B15F ON diplome_full');
        $this->addSql('ALTER TABLE diplome_full DROP type_id, DROP name_id, DROP categorie_id, DROP base_autorisation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE diplome_categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE diplome_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE diplome_nom (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE numero_habilitation DROP FOREIGN KEY FK_AC2847461B65292');
        $this->addSql('ALTER TABLE numero_habilitation_centre DROP FOREIGN KEY FK_FC19B51998DB45D6');
        $this->addSql('ALTER TABLE numero_habilitation_centre DROP FOREIGN KEY FK_FC19B519463CD7C3');
        $this->addSql('DROP TABLE numero_habilitation');
        $this->addSql('DROP TABLE numero_habilitation_centre');
        $this->addSql('ALTER TABLE diplome_full ADD type_id INT DEFAULT NULL, ADD name_id INT DEFAULT NULL, ADD categorie_id INT DEFAULT NULL, ADD base_autorisation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE diplome_full ADD CONSTRAINT FK_F7ED9CF03171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE diplome_full ADD CONSTRAINT FK_F7ED9CF071179CD6 FOREIGN KEY (name_id) REFERENCES diplome_nom (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE diplome_full ADD CONSTRAINT FK_F7ED9CF0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES diplome_categorie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE diplome_full ADD CONSTRAINT FK_F7ED9CF0C54C8C93 FOREIGN KEY (type_id) REFERENCES diplome_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F7ED9CF0C54C8C93 ON diplome_full (type_id)');
        $this->addSql('CREATE INDEX IDX_F7ED9CF071179CD6 ON diplome_full (name_id)');
        $this->addSql('CREATE INDEX IDX_F7ED9CF0BCF5E72D ON diplome_full (categorie_id)');
        $this->addSql('CREATE INDEX IDX_F7ED9CF03171B15F ON diplome_full (base_autorisation_id)');
    }
}
