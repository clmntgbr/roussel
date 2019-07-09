<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190709140126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE note ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14DE12AB56 ON note (created_by)');
        $this->addSql('ALTER TABLE address ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D4E6F81DE12AB56 ON address (created_by)');
        $this->addSql('ALTER TABLE specialty ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specialty ADD CONSTRAINT FK_E066A6ECDE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E066A6ECDE12AB56 ON specialty (created_by)');
        $this->addSql('ALTER TABLE implantation ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE implantation ADD CONSTRAINT FK_16DC605DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_16DC605DE12AB56 ON implantation (created_by)');
        $this->addSql('ALTER TABLE user ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DE12AB56 ON user (created_by)');
        $this->addSql('ALTER TABLE person ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_34DCD176DE12AB56 ON person (created_by)');
        $this->addSql('ALTER TABLE target ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFCDE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_466F2FFCDE12AB56 ON target (created_by)');
        $this->addSql('ALTER TABLE funds_under_management ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE funds_under_management ADD CONSTRAINT FK_61A89C00DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_61A89C00DE12AB56 ON funds_under_management (created_by)');
        $this->addSql('ALTER TABLE operation ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66DDE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1981A66DDE12AB56 ON operation (created_by)');
        $this->addSql('ALTER TABLE media ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CDE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CDE12AB56 ON media (created_by)');
        $this->addSql('ALTER TABLE positioning ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE positioning ADD CONSTRAINT FK_2B2A7019DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2B2A7019DE12AB56 ON positioning (created_by)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81DE12AB56');
        $this->addSql('DROP INDEX IDX_D4E6F81DE12AB56 ON address');
        $this->addSql('ALTER TABLE address DROP created_by');
        $this->addSql('ALTER TABLE funds_under_management DROP FOREIGN KEY FK_61A89C00DE12AB56');
        $this->addSql('DROP INDEX IDX_61A89C00DE12AB56 ON funds_under_management');
        $this->addSql('ALTER TABLE funds_under_management DROP created_by');
        $this->addSql('ALTER TABLE implantation DROP FOREIGN KEY FK_16DC605DE12AB56');
        $this->addSql('DROP INDEX IDX_16DC605DE12AB56 ON implantation');
        $this->addSql('ALTER TABLE implantation DROP created_by');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CDE12AB56');
        $this->addSql('DROP INDEX IDX_6A2CA10CDE12AB56 ON media');
        $this->addSql('ALTER TABLE media DROP created_by');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14DE12AB56');
        $this->addSql('DROP INDEX IDX_CFBDFA14DE12AB56 ON note');
        $this->addSql('ALTER TABLE note DROP created_by');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66DDE12AB56');
        $this->addSql('DROP INDEX IDX_1981A66DDE12AB56 ON operation');
        $this->addSql('ALTER TABLE operation DROP created_by');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176DE12AB56');
        $this->addSql('DROP INDEX IDX_34DCD176DE12AB56 ON person');
        $this->addSql('ALTER TABLE person DROP created_by');
        $this->addSql('ALTER TABLE positioning DROP FOREIGN KEY FK_2B2A7019DE12AB56');
        $this->addSql('DROP INDEX IDX_2B2A7019DE12AB56 ON positioning');
        $this->addSql('ALTER TABLE positioning DROP created_by');
        $this->addSql('ALTER TABLE specialty DROP FOREIGN KEY FK_E066A6ECDE12AB56');
        $this->addSql('DROP INDEX IDX_E066A6ECDE12AB56 ON specialty');
        $this->addSql('ALTER TABLE specialty DROP created_by');
        $this->addSql('ALTER TABLE target DROP FOREIGN KEY FK_466F2FFCDE12AB56');
        $this->addSql('DROP INDEX IDX_466F2FFCDE12AB56 ON target');
        $this->addSql('ALTER TABLE target DROP created_by');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DE12AB56');
        $this->addSql('DROP INDEX IDX_8D93D649DE12AB56 ON user');
        $this->addSql('ALTER TABLE user DROP created_by');
    }
}
