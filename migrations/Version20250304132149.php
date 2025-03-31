<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304132149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE games ADD created_by_id INT DEFAULT NULL, DROP created_by');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B31B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FF232B31B03A8386 ON games (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE games DROP FOREIGN KEY FK_FF232B31B03A8386');
        $this->addSql('DROP INDEX IDX_FF232B31B03A8386 ON games');
        $this->addSql('ALTER TABLE games ADD created_by VARCHAR(255) DEFAULT NULL, DROP created_by_id');
    }
}
