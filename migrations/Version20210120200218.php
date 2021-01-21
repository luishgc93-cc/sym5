<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120200218 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE archivo (id INT AUTO_INCREMENT NOT NULL, archivo_id INT NOT NULL, INDEX IDX_3529B48246EBF93B (archivo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE archivo ADD CONSTRAINT FK_3529B48246EBF93B FOREIGN KEY (archivo_id) REFERENCES tasks (id)');
        $this->addSql('ALTER TABLE tasks CHANGE user_id user_id VARCHAR(255) DEFAULT NULL, CHANGE estado estado VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE archivo');
        $this->addSql('ALTER TABLE tasks CHANGE user_id user_id INT DEFAULT NULL, CHANGE estado estado VARCHAR(30) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
    }
}
