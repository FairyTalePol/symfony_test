<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20201016085839 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE attachment DROP CONSTRAINT fk_795fd9bb4727dc89');
        $this->addSql('DROP INDEX idx_795fd9bb4727dc89');
        $this->addSql('ALTER TABLE attachment RENAME COLUMN advertisementid TO advertisement');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BBC95F6AEE FOREIGN KEY (advertisement) REFERENCES advertisement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_795FD9BBC95F6AEE ON attachment (advertisement)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE attachment DROP CONSTRAINT FK_795FD9BBC95F6AEE');
        $this->addSql('DROP INDEX IDX_795FD9BBC95F6AEE');
        $this->addSql('ALTER TABLE attachment RENAME COLUMN advertisement TO advertisementid');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT fk_795fd9bb4727dc89 FOREIGN KEY (advertisementid) REFERENCES advertisement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_795fd9bb4727dc89 ON attachment (advertisementid)');
    }
}
