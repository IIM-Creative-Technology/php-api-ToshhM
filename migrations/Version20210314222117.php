<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210314222117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervenant (id INT AUTO_INCREMENT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_73D0145CF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE etudiant ADD classes_id INT NOT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E39E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_717E22E39E225B24 ON etudiant (classes_id)');
        $this->addSql('ALTER TABLE matiere ADD classe_id INT NOT NULL');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A8F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_9014574A8F5EA509 ON matiere (classe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E39E225B24');
        $this->addSql('DROP INDEX IDX_717E22E39E225B24 ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP classes_id');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A8F5EA509');
        $this->addSql('DROP INDEX IDX_9014574A8F5EA509 ON matiere');
        $this->addSql('ALTER TABLE matiere DROP classe_id');
    }
}
