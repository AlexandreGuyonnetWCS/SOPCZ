<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230412074718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base_autorisation_diplome DROP FOREIGN KEY FK_B1AA556726F859E2');
        $this->addSql('ALTER TABLE base_autorisation_diplome DROP FOREIGN KEY FK_B1AA55673171B15F');
        $this->addSql('ALTER TABLE diplome DROP FOREIGN KEY FK_EB4C4D4ED0CAEDC4');
        $this->addSql('DROP TABLE base_autorisation_diplome');
        $this->addSql('DROP TABLE diplome');
        $this->addSql('ALTER TABLE diplome_full ADD base_autorisation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE diplome_full ADD CONSTRAINT FK_F7ED9CF03171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id)');
        $this->addSql('CREATE INDEX IDX_F7ED9CF03171B15F ON diplome_full (base_autorisation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE base_autorisation_diplome (base_autorisation_id INT NOT NULL, diplome_id INT NOT NULL, INDEX IDX_B1AA556726F859E2 (diplome_id), INDEX IDX_B1AA55673171B15F (base_autorisation_id), PRIMARY KEY(base_autorisation_id, diplome_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE diplome (id INT AUTO_INCREMENT NOT NULL, diplome_full_id INT DEFAULT NULL, validite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_EB4C4D4ED0CAEDC4 (diplome_full_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE base_autorisation_diplome ADD CONSTRAINT FK_B1AA556726F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE base_autorisation_diplome ADD CONSTRAINT FK_B1AA55673171B15F FOREIGN KEY (base_autorisation_id) REFERENCES base_autorisation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE diplome ADD CONSTRAINT FK_EB4C4D4ED0CAEDC4 FOREIGN KEY (diplome_full_id) REFERENCES diplome_full (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE diplome_full DROP FOREIGN KEY FK_F7ED9CF03171B15F');
        $this->addSql('DROP INDEX IDX_F7ED9CF03171B15F ON diplome_full');
        $this->addSql('ALTER TABLE diplome_full DROP base_autorisation_id');
    }
}
