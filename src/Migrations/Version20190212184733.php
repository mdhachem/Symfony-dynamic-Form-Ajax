<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190212184733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, gouvernorat_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2D5B023475B74E2D (gouvernorat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gouvernorat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_DD5A5B7D8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B023475B74E2D FOREIGN KEY (gouvernorat_id) REFERENCES gouvernorat (id)');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7D8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7D8BAC62AF');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B023475B74E2D');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE gouvernorat');
        $this->addSql('DROP TABLE plan');
    }
}
