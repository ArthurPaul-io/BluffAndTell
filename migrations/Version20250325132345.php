<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250325132345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecrire ADD ecrivain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ecrire ADD CONSTRAINT FK_918824CCFBEED4E6 FOREIGN KEY (ecrivain_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_918824CCFBEED4E6 ON ecrire (ecrivain_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B7926419');
        $this->addSql('DROP INDEX IDX_8D93D649B7926419 ON user');
        $this->addSql('ALTER TABLE user DROP sesannecdotes_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD sesannecdotes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B7926419 FOREIGN KEY (sesannecdotes_id) REFERENCES ecrire (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B7926419 ON user (sesannecdotes_id)');
        $this->addSql('ALTER TABLE ecrire DROP FOREIGN KEY FK_918824CCFBEED4E6');
        $this->addSql('DROP INDEX IDX_918824CCFBEED4E6 ON ecrire');
        $this->addSql('ALTER TABLE ecrire DROP ecrivain_id');
    }
}
