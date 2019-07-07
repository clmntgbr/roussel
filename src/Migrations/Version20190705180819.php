<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190705180819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE leader (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL, birthday DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialty (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE implantation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, investment_fund VARCHAR(255) NOT NULL, parent_company VARCHAR(255) NOT NULL, holding VARCHAR(255) NOT NULL, sector VARCHAR(255) NOT NULL, age VARCHAR(255) NOT NULL, activity VARCHAR(255) NOT NULL, turnover VARCHAR(255) NOT NULL, gross_operating_surplus VARCHAR(255) NOT NULL, profit_before_interest_and_taxes VARCHAR(255) NOT NULL, treasury VARCHAR(255) NOT NULL, financial_debt VARCHAR(255) NOT NULL, siren VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_turnover DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D6461F2F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_leader (society_id INT NOT NULL, leader_id INT NOT NULL, INDEX IDX_A241F30BE6389D24 (society_id), INDEX IDX_A241F30B73154ED4 (leader_id), PRIMARY KEY(society_id, leader_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_note (society_id INT NOT NULL, note_id INT NOT NULL, INDEX IDX_D98604E5E6389D24 (society_id), INDEX IDX_D98604E526ED0855 (note_id), PRIMARY KEY(society_id, note_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_operation (society_id INT NOT NULL, operation_id INT NOT NULL, INDEX IDX_3ECA01B2E6389D24 (society_id), INDEX IDX_3ECA01B244AC3583 (operation_id), PRIMARY KEY(society_id, operation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_implantation (society_id INT NOT NULL, implantation_id INT NOT NULL, INDEX IDX_87F00619E6389D24 (society_id), INDEX IDX_87F00619CE296AF7 (implantation_id), PRIMARY KEY(society_id, implantation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_specialty (society_id INT NOT NULL, specialty_id INT NOT NULL, INDEX IDX_C72D0133E6389D24 (society_id), INDEX IDX_C72D01339A353316 (specialty_id), PRIMARY KEY(society_id, specialty_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE society ADD CONSTRAINT FK_D6461F2F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_leader ADD CONSTRAINT FK_A241F30BE6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_leader ADD CONSTRAINT FK_A241F30B73154ED4 FOREIGN KEY (leader_id) REFERENCES leader (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_note ADD CONSTRAINT FK_D98604E5E6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_note ADD CONSTRAINT FK_D98604E526ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_operation ADD CONSTRAINT FK_3ECA01B2E6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_operation ADD CONSTRAINT FK_3ECA01B244AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_implantation ADD CONSTRAINT FK_87F00619E6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_implantation ADD CONSTRAINT FK_87F00619CE296AF7 FOREIGN KEY (implantation_id) REFERENCES implantation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_specialty ADD CONSTRAINT FK_C72D0133E6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_specialty ADD CONSTRAINT FK_C72D01339A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE society_leader DROP FOREIGN KEY FK_A241F30B73154ED4');
        $this->addSql('ALTER TABLE society DROP FOREIGN KEY FK_D6461F2F5B7AF75');
        $this->addSql('ALTER TABLE society_specialty DROP FOREIGN KEY FK_C72D01339A353316');
        $this->addSql('ALTER TABLE society_implantation DROP FOREIGN KEY FK_87F00619CE296AF7');
        $this->addSql('ALTER TABLE society_leader DROP FOREIGN KEY FK_A241F30BE6389D24');
        $this->addSql('ALTER TABLE society_note DROP FOREIGN KEY FK_D98604E5E6389D24');
        $this->addSql('ALTER TABLE society_operation DROP FOREIGN KEY FK_3ECA01B2E6389D24');
        $this->addSql('ALTER TABLE society_implantation DROP FOREIGN KEY FK_87F00619E6389D24');
        $this->addSql('ALTER TABLE society_specialty DROP FOREIGN KEY FK_C72D0133E6389D24');
        $this->addSql('ALTER TABLE society_operation DROP FOREIGN KEY FK_3ECA01B244AC3583');
        $this->addSql('DROP TABLE leader');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE specialty');
        $this->addSql('DROP TABLE implantation');
        $this->addSql('DROP TABLE society');
        $this->addSql('DROP TABLE society_leader');
        $this->addSql('DROP TABLE society_note');
        $this->addSql('DROP TABLE society_operation');
        $this->addSql('DROP TABLE society_implantation');
        $this->addSql('DROP TABLE society_specialty');
        $this->addSql('DROP TABLE operation');
    }
}
