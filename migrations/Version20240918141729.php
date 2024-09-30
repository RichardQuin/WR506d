<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240918141729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) NOT NULL, dob DATE DEFAULT NULL, awards INT DEFAULT NULL, bio LONGTEXT DEFAULT NULL, nationality VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, gender VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categori (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categori_movie (categori_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_92B321E8425FCA7D (categori_id), INDEX IDX_92B321E88F93B6FC (movie_id), PRIMARY KEY(categori_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, release_date DATE DEFAULT NULL, duration INT DEFAULT NULL, entries INT DEFAULT NULL, director VARCHAR(255) DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, media VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_actor (movie_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_3A374C658F93B6FC (movie_id), INDEX IDX_3A374C6510DAF24A (actor_id), PRIMARY KEY(movie_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_categori (movie_id INT NOT NULL, categori_id INT NOT NULL, INDEX IDX_C70D92288F93B6FC (movie_id), INDEX IDX_C70D9228425FCA7D (categori_id), PRIMARY KEY(movie_id, categori_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categori_movie ADD CONSTRAINT FK_92B321E8425FCA7D FOREIGN KEY (categori_id) REFERENCES categori (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categori_movie ADD CONSTRAINT FK_92B321E88F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C658F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C6510DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_categori ADD CONSTRAINT FK_C70D92288F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_categori ADD CONSTRAINT FK_C70D9228425FCA7D FOREIGN KEY (categori_id) REFERENCES categori (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categori_movie DROP FOREIGN KEY FK_92B321E8425FCA7D');
        $this->addSql('ALTER TABLE categori_movie DROP FOREIGN KEY FK_92B321E88F93B6FC');
        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C658F93B6FC');
        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C6510DAF24A');
        $this->addSql('ALTER TABLE movie_categori DROP FOREIGN KEY FK_C70D92288F93B6FC');
        $this->addSql('ALTER TABLE movie_categori DROP FOREIGN KEY FK_C70D9228425FCA7D');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE categori');
        $this->addSql('DROP TABLE categori_movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_actor');
        $this->addSql('DROP TABLE movie_categori');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
