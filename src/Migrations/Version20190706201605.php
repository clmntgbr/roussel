<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190706201605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD preview_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1CDE46FDB FOREIGN KEY (preview_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_723705D1CDE46FDB ON transaction (preview_id)');
        $this->addSql('ALTER TABLE article ADD preview_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66CDE46FDB FOREIGN KEY (preview_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66CDE46FDB ON article (preview_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66CDE46FDB');
        $this->addSql('DROP INDEX UNIQ_23A0E66CDE46FDB ON article');
        $this->addSql('ALTER TABLE article DROP preview_id');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1CDE46FDB');
        $this->addSql('DROP INDEX UNIQ_723705D1CDE46FDB ON transaction');
        $this->addSql('ALTER TABLE transaction DROP preview_id');
    }
}
