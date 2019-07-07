<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190706192735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE society_leader DROP FOREIGN KEY FK_A241F30B73154ED4');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL, birthday DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE target (id INT AUTO_INCREMENT NOT NULL, geography VARCHAR(255) NOT NULL, ve VARCHAR(255) NOT NULL, investment_ticket VARCHAR(255) NOT NULL, investment_sector VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investment_fund (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, positioning_id INT DEFAULT NULL, target_id INT DEFAULT NULL, funds_under_management_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_AFD32BC6F5B7AF75 (address_id), UNIQUE INDEX UNIQ_AFD32BC68132EDC4 (positioning_id), UNIQUE INDEX UNIQ_AFD32BC6158E0B66 (target_id), UNIQUE INDEX UNIQ_AFD32BC663B82B9D (funds_under_management_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investment_fund_note (investment_fund_id INT NOT NULL, note_id INT NOT NULL, INDEX IDX_25AE94049AC9516A (investment_fund_id), INDEX IDX_25AE940426ED0855 (note_id), PRIMARY KEY(investment_fund_id, note_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investment_fund_contact (investment_fund_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_2F8442559AC9516A (investment_fund_id), INDEX IDX_2F844255217BBB47 (person_id), PRIMARY KEY(investment_fund_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funds_under_management (id INT AUTO_INCREMENT NOT NULL, capital_structure VARCHAR(255) NOT NULL, managed_capital VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE positioning (id INT AUTO_INCREMENT NOT NULL, operation_type VARCHAR(255) NOT NULL, approach VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE investment_fund ADD CONSTRAINT FK_AFD32BC6F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund ADD CONSTRAINT FK_AFD32BC68132EDC4 FOREIGN KEY (positioning_id) REFERENCES positioning (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund ADD CONSTRAINT FK_AFD32BC6158E0B66 FOREIGN KEY (target_id) REFERENCES target (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund ADD CONSTRAINT FK_AFD32BC663B82B9D FOREIGN KEY (funds_under_management_id) REFERENCES funds_under_management (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund_note ADD CONSTRAINT FK_25AE94049AC9516A FOREIGN KEY (investment_fund_id) REFERENCES investment_fund (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund_note ADD CONSTRAINT FK_25AE940426ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund_contact ADD CONSTRAINT FK_2F8442559AC9516A FOREIGN KEY (investment_fund_id) REFERENCES investment_fund (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund_contact ADD CONSTRAINT FK_2F844255217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE leader');
        $this->addSql('DROP INDEX IDX_A241F30B73154ED4 ON society_leader');
        $this->addSql('ALTER TABLE society_leader DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE society_leader CHANGE leader_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE society_leader ADD CONSTRAINT FK_A241F30B217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_A241F30B217BBB47 ON society_leader (person_id)');
        $this->addSql('ALTER TABLE society_leader ADD PRIMARY KEY (society_id, person_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE investment_fund_contact DROP FOREIGN KEY FK_2F844255217BBB47');
        $this->addSql('ALTER TABLE society_leader DROP FOREIGN KEY FK_A241F30B217BBB47');
        $this->addSql('ALTER TABLE investment_fund DROP FOREIGN KEY FK_AFD32BC6158E0B66');
        $this->addSql('ALTER TABLE investment_fund_note DROP FOREIGN KEY FK_25AE94049AC9516A');
        $this->addSql('ALTER TABLE investment_fund_contact DROP FOREIGN KEY FK_2F8442559AC9516A');
        $this->addSql('ALTER TABLE investment_fund DROP FOREIGN KEY FK_AFD32BC663B82B9D');
        $this->addSql('ALTER TABLE investment_fund DROP FOREIGN KEY FK_AFD32BC68132EDC4');
        $this->addSql('CREATE TABLE leader (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, position VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, phone_number VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, contact_email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, birthday DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE target');
        $this->addSql('DROP TABLE investment_fund');
        $this->addSql('DROP TABLE investment_fund_note');
        $this->addSql('DROP TABLE investment_fund_contact');
        $this->addSql('DROP TABLE funds_under_management');
        $this->addSql('DROP TABLE positioning');
        $this->addSql('DROP INDEX IDX_A241F30B217BBB47 ON society_leader');
        $this->addSql('ALTER TABLE society_leader DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE society_leader CHANGE person_id leader_id INT NOT NULL');
        $this->addSql('ALTER TABLE society_leader ADD CONSTRAINT FK_A241F30B73154ED4 FOREIGN KEY (leader_id) REFERENCES leader (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_A241F30B73154ED4 ON society_leader (leader_id)');
        $this->addSql('ALTER TABLE society_leader ADD PRIMARY KEY (society_id, leader_id)');
    }
}
