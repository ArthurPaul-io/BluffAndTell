<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241113121130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, lutilisateur_id INT NOT NULL, contenu VARCHAR(255) NOT NULL, senddate VARCHAR(255) NOT NULL, INDEX IDX_659DF2AAFA2B7768 (lutilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecrire (id INT AUTO_INCREMENT NOT NULL, contenu LONGTEXT NOT NULL, bluffoutell TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE games (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, round_count INT NOT NULL, game_statut VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rounds (id INT AUTO_INCREMENT NOT NULL, letheme_id INT NOT NULL, lanecdote_id INT DEFAULT NULL, lapartie_id INT DEFAULT NULL, rounds_id INT NOT NULL, rounds_number INT NOT NULL, INDEX IDX_3A7FD554285E38D (letheme_id), INDEX IDX_3A7FD5545F98710B (lanecdote_id), INDEX IDX_3A7FD5549103957 (lapartie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, createur_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9775E70873A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, sesannecdotes_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) DEFAULT NULL, createdaccount DATE DEFAULT NULL, INDEX IDX_8D93D649B7926419 (sesannecdotes_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_game (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, game_id INT DEFAULT NULL, role VARCHAR(255) NOT NULL, INDEX IDX_59AA7D45A76ED395 (user_id), INDEX IDX_59AA7D45E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAFA2B7768 FOREIGN KEY (lutilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rounds ADD CONSTRAINT FK_3A7FD554285E38D FOREIGN KEY (letheme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE rounds ADD CONSTRAINT FK_3A7FD5545F98710B FOREIGN KEY (lanecdote_id) REFERENCES ecrire (id)');
        $this->addSql('ALTER TABLE rounds ADD CONSTRAINT FK_3A7FD5549103957 FOREIGN KEY (lapartie_id) REFERENCES games (id)');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E70873A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B7926419 FOREIGN KEY (sesannecdotes_id) REFERENCES ecrire (id)');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45E48FD905 FOREIGN KEY (game_id) REFERENCES games (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAFA2B7768');
        $this->addSql('ALTER TABLE rounds DROP FOREIGN KEY FK_3A7FD554285E38D');
        $this->addSql('ALTER TABLE rounds DROP FOREIGN KEY FK_3A7FD5545F98710B');
        $this->addSql('ALTER TABLE rounds DROP FOREIGN KEY FK_3A7FD5549103957');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E70873A201E5');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B7926419');
        $this->addSql('ALTER TABLE user_game DROP FOREIGN KEY FK_59AA7D45A76ED395');
        $this->addSql('ALTER TABLE user_game DROP FOREIGN KEY FK_59AA7D45E48FD905');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE ecrire');
        $this->addSql('DROP TABLE games');
        $this->addSql('DROP TABLE rounds');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_game');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
