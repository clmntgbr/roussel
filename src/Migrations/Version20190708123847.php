<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190708123847 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, preview_id INT DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, date DATETIME DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_723705D1CDE46FDB (preview_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialty (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE implantation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, position VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, contact_email VARCHAR(255) DEFAULT NULL, birthday DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE target (id INT AUTO_INCREMENT NOT NULL, geography VARCHAR(255) DEFAULT NULL, ve VARCHAR(255) DEFAULT NULL, investment_ticket VARCHAR(255) DEFAULT NULL, investment_sector VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investment_fund (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, positioning_id INT DEFAULT NULL, target_id INT DEFAULT NULL, funds_under_management_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, contact_email VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, date_creation DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_AFD32BC6F5B7AF75 (address_id), UNIQUE INDEX UNIQ_AFD32BC68132EDC4 (positioning_id), UNIQUE INDEX UNIQ_AFD32BC6158E0B66 (target_id), UNIQUE INDEX UNIQ_AFD32BC663B82B9D (funds_under_management_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investment_fund_note (investment_fund_id INT NOT NULL, note_id INT NOT NULL, INDEX IDX_25AE94049AC9516A (investment_fund_id), INDEX IDX_25AE940426ED0855 (note_id), PRIMARY KEY(investment_fund_id, note_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investment_fund_contact (investment_fund_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_2F8442559AC9516A (investment_fund_id), INDEX IDX_2F844255217BBB47 (person_id), PRIMARY KEY(investment_fund_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, investment_fund VARCHAR(255) DEFAULT NULL, parent_company VARCHAR(255) DEFAULT NULL, holding VARCHAR(255) DEFAULT NULL, sector VARCHAR(255) DEFAULT NULL, age VARCHAR(255) DEFAULT NULL, activity VARCHAR(255) DEFAULT NULL, turnover VARCHAR(255) DEFAULT NULL, gross_operating_surplus VARCHAR(255) DEFAULT NULL, profit_before_interest_and_taxes VARCHAR(255) DEFAULT NULL, treasury VARCHAR(255) DEFAULT NULL, financial_debt VARCHAR(255) DEFAULT NULL, siren VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, contact_email VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, date_creation DATETIME DEFAULT NULL, date_turnover DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D6461F2F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_leader (society_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_A241F30BE6389D24 (society_id), INDEX IDX_A241F30B217BBB47 (person_id), PRIMARY KEY(society_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_note (society_id INT NOT NULL, note_id INT NOT NULL, INDEX IDX_D98604E5E6389D24 (society_id), INDEX IDX_D98604E526ED0855 (note_id), PRIMARY KEY(society_id, note_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_operation (society_id INT NOT NULL, operation_id INT NOT NULL, INDEX IDX_3ECA01B2E6389D24 (society_id), INDEX IDX_3ECA01B244AC3583 (operation_id), PRIMARY KEY(society_id, operation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_implantation (society_id INT NOT NULL, implantation_id INT NOT NULL, INDEX IDX_87F00619E6389D24 (society_id), INDEX IDX_87F00619CE296AF7 (implantation_id), PRIMARY KEY(society_id, implantation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_specialty (society_id INT NOT NULL, specialty_id INT NOT NULL, INDEX IDX_C72D0133E6389D24 (society_id), INDEX IDX_C72D01339A353316 (specialty_id), PRIMARY KEY(society_id, specialty_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funds_under_management (id INT AUTO_INCREMENT NOT NULL, capital_structure VARCHAR(255) DEFAULT NULL, managed_capital VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, preview_id INT DEFAULT NULL, title LONGTEXT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, time_to_read DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, created_by VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_23A0E66CDE46FDB (preview_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE positioning (id INT AUTO_INCREMENT NOT NULL, operation_type VARCHAR(255) DEFAULT NULL, approach VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1CDE46FDB FOREIGN KEY (preview_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund ADD CONSTRAINT FK_AFD32BC6F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund ADD CONSTRAINT FK_AFD32BC68132EDC4 FOREIGN KEY (positioning_id) REFERENCES positioning (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund ADD CONSTRAINT FK_AFD32BC6158E0B66 FOREIGN KEY (target_id) REFERENCES target (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund ADD CONSTRAINT FK_AFD32BC663B82B9D FOREIGN KEY (funds_under_management_id) REFERENCES funds_under_management (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund_note ADD CONSTRAINT FK_25AE94049AC9516A FOREIGN KEY (investment_fund_id) REFERENCES investment_fund (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund_note ADD CONSTRAINT FK_25AE940426ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund_contact ADD CONSTRAINT FK_2F8442559AC9516A FOREIGN KEY (investment_fund_id) REFERENCES investment_fund (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE investment_fund_contact ADD CONSTRAINT FK_2F844255217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society ADD CONSTRAINT FK_D6461F2F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_leader ADD CONSTRAINT FK_A241F30BE6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_leader ADD CONSTRAINT FK_A241F30B217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_note ADD CONSTRAINT FK_D98604E5E6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_note ADD CONSTRAINT FK_D98604E526ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_operation ADD CONSTRAINT FK_3ECA01B2E6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_operation ADD CONSTRAINT FK_3ECA01B244AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_implantation ADD CONSTRAINT FK_87F00619E6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_implantation ADD CONSTRAINT FK_87F00619CE296AF7 FOREIGN KEY (implantation_id) REFERENCES implantation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_specialty ADD CONSTRAINT FK_C72D0133E6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_specialty ADD CONSTRAINT FK_C72D01339A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66CDE46FDB FOREIGN KEY (preview_id) REFERENCES media (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE investment_fund_note DROP FOREIGN KEY FK_25AE940426ED0855');
        $this->addSql('ALTER TABLE society_note DROP FOREIGN KEY FK_D98604E526ED0855');
        $this->addSql('ALTER TABLE investment_fund DROP FOREIGN KEY FK_AFD32BC6F5B7AF75');
        $this->addSql('ALTER TABLE society DROP FOREIGN KEY FK_D6461F2F5B7AF75');
        $this->addSql('ALTER TABLE society_specialty DROP FOREIGN KEY FK_C72D01339A353316');
        $this->addSql('ALTER TABLE society_implantation DROP FOREIGN KEY FK_87F00619CE296AF7');
        $this->addSql('ALTER TABLE investment_fund_contact DROP FOREIGN KEY FK_2F844255217BBB47');
        $this->addSql('ALTER TABLE society_leader DROP FOREIGN KEY FK_A241F30B217BBB47');
        $this->addSql('ALTER TABLE investment_fund DROP FOREIGN KEY FK_AFD32BC6158E0B66');
        $this->addSql('ALTER TABLE investment_fund_note DROP FOREIGN KEY FK_25AE94049AC9516A');
        $this->addSql('ALTER TABLE investment_fund_contact DROP FOREIGN KEY FK_2F8442559AC9516A');
        $this->addSql('ALTER TABLE society_leader DROP FOREIGN KEY FK_A241F30BE6389D24');
        $this->addSql('ALTER TABLE society_note DROP FOREIGN KEY FK_D98604E5E6389D24');
        $this->addSql('ALTER TABLE society_operation DROP FOREIGN KEY FK_3ECA01B2E6389D24');
        $this->addSql('ALTER TABLE society_implantation DROP FOREIGN KEY FK_87F00619E6389D24');
        $this->addSql('ALTER TABLE society_specialty DROP FOREIGN KEY FK_C72D0133E6389D24');
        $this->addSql('ALTER TABLE investment_fund DROP FOREIGN KEY FK_AFD32BC663B82B9D');
        $this->addSql('ALTER TABLE society_operation DROP FOREIGN KEY FK_3ECA01B244AC3583');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1CDE46FDB');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66CDE46FDB');
        $this->addSql('ALTER TABLE investment_fund DROP FOREIGN KEY FK_AFD32BC68132EDC4');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE specialty');
        $this->addSql('DROP TABLE implantation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE target');
        $this->addSql('DROP TABLE investment_fund');
        $this->addSql('DROP TABLE investment_fund_note');
        $this->addSql('DROP TABLE investment_fund_contact');
        $this->addSql('DROP TABLE society');
        $this->addSql('DROP TABLE society_leader');
        $this->addSql('DROP TABLE society_note');
        $this->addSql('DROP TABLE society_operation');
        $this->addSql('DROP TABLE society_implantation');
        $this->addSql('DROP TABLE society_specialty');
        $this->addSql('DROP TABLE funds_under_management');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE positioning');
    }
}
