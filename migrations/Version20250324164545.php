<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250324164545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rounds DROP FOREIGN KEY FK_3A7FD5545F98710B');
        $this->addSql('DROP INDEX IDX_3A7FD5545F98710B ON rounds');
        $this->addSql('ALTER TABLE rounds DROP lanecdote_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rounds ADD lanecdote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rounds ADD CONSTRAINT FK_3A7FD5545F98710B FOREIGN KEY (lanecdote_id) REFERENCES ecrire (id)');
        $this->addSql('CREATE INDEX IDX_3A7FD5545F98710B ON rounds (lanecdote_id)');
    }
}
