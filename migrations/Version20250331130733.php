<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250331130733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecrire DROP FOREIGN KEY FK_918824CCF6DBB035');
        $this->addSql('ALTER TABLE ecrire CHANGE id_round_id id_round_id INT NOT NULL');
        $this->addSql('ALTER TABLE ecrire ADD CONSTRAINT FK_918824CCF6DBB035 FOREIGN KEY (id_round_id) REFERENCES rounds (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecrire DROP FOREIGN KEY FK_918824CCF6DBB035');
        $this->addSql('ALTER TABLE ecrire CHANGE id_round_id id_round_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ecrire ADD CONSTRAINT FK_918824CCF6DBB035 FOREIGN KEY (id_round_id) REFERENCES rounds (id)');
    }
}
