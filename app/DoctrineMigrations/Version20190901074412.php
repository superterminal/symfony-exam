<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190901074412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tv_episode (id INT AUTO_INCREMENT NOT NULL, air_date VARCHAR(255) NOT NULL, episode_count INT NOT NULL, name VARCHAR(255) NOT NULL, overview LONGTEXT NOT NULL, poster_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_show (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_by LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', episode_run_time LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', first_air_date VARCHAR(255) NOT NULL, genres LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', homepage VARCHAR(255) NOT NULL, in_production TINYINT(1) NOT NULL, languages LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', number_of_episodes INT NOT NULL, number_of_seasons INT NOT NULL, origin_country LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', overview LONGTEXT NOT NULL, poster_path VARCHAR(255) NOT NULL, production_companies LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', seasons LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birthday VARCHAR(255) NOT NULL, place_of_birth VARCHAR(255) NOT NULL, biography LONGTEXT NOT NULL, imdb_id VARCHAR(255) NOT NULL, profile_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE base_tv_show (id INT AUTO_INCREMENT NOT NULL, original_name VARCHAR(255) NOT NULL, poster_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments CHANGE movie_id production_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tv_episode');
        $this->addSql('DROP TABLE tv_show');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE base_tv_show');
        $this->addSql('ALTER TABLE comments CHANGE production_id movie_id INT NOT NULL');
    }
}
