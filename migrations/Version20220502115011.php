<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502115011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, capacity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD id_department_id INT NOT NULL, DROP created_at');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3310A824BA FOREIGN KEY (id_department_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_B723AF3310A824BA ON student (id_department_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3310A824BA');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP INDEX IDX_B723AF3310A824BA ON student');
        $this->addSql('ALTER TABLE student ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP id_department_id');
    }
}
