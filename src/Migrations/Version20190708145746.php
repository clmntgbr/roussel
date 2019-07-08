<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190708145746 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction CHANGE created_by created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_723705D1DE12AB56 ON transaction (created_by)');
        $this->addSql('ALTER TABLE investment_fund CHANGE created_by created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE investment_fund ADD CONSTRAINT FK_AFD32BC6DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AFD32BC6DE12AB56 ON investment_fund (created_by)');
        $this->addSql('ALTER TABLE society CHANGE created_by created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE society ADD CONSTRAINT FK_D6461F2DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D6461F2DE12AB56 ON society (created_by)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE investment_fund DROP FOREIGN KEY FK_AFD32BC6DE12AB56');
        $this->addSql('DROP INDEX IDX_AFD32BC6DE12AB56 ON investment_fund');
        $this->addSql('ALTER TABLE investment_fund CHANGE created_by created_by VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE society DROP FOREIGN KEY FK_D6461F2DE12AB56');
        $this->addSql('DROP INDEX IDX_D6461F2DE12AB56 ON society');
        $this->addSql('ALTER TABLE society CHANGE created_by created_by VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1DE12AB56');
        $this->addSql('DROP INDEX IDX_723705D1DE12AB56 ON transaction');
        $this->addSql('ALTER TABLE transaction CHANGE created_by created_by VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
