<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190707164122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE investment_fund DROP FOREIGN KEY FK_AFD32BC6F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_AFD32BC6F5B7AF75 ON investment_fund');
        $this->addSql('ALTER TABLE investment_fund ADD street VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD postal_code VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, DROP address_id');
        $this->addSql('ALTER TABLE society DROP FOREIGN KEY FK_D6461F2F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_D6461F2F5B7AF75 ON society');
        $this->addSql('ALTER TABLE society ADD street VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD postal_code VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, DROP address_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE investment_fund ADD address_id INT DEFAULT NULL, DROP street, DROP city, DROP postal_code, DROP country');
        $this->addSql('ALTER TABLE investment_fund ADD CONSTRAINT FK_AFD32BC6F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AFD32BC6F5B7AF75 ON investment_fund (address_id)');
        $this->addSql('ALTER TABLE society ADD address_id INT DEFAULT NULL, DROP street, DROP city, DROP postal_code, DROP country');
        $this->addSql('ALTER TABLE society ADD CONSTRAINT FK_D6461F2F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D6461F2F5B7AF75 ON society (address_id)');
    }
}
