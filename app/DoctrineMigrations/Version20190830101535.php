<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190830101535 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE watched ADD author_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE watched ADD CONSTRAINT FK_465B53FDF675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_465B53FDF675F31B ON watched (author_id)');
        $this->addSql('ALTER TABLE unwatched ADD author_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE unwatched ADD CONSTRAINT FK_426BAC3EF675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_426BAC3EF675F31B ON unwatched (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE unwatched DROP FOREIGN KEY FK_426BAC3EF675F31B');
        $this->addSql('DROP INDEX IDX_426BAC3EF675F31B ON unwatched');
        $this->addSql('ALTER TABLE unwatched ADD user_id INT NOT NULL, DROP author_id');
        $this->addSql('ALTER TABLE watched DROP FOREIGN KEY FK_465B53FDF675F31B');
        $this->addSql('DROP INDEX IDX_465B53FDF675F31B ON watched');
        $this->addSql('ALTER TABLE watched ADD user_id INT NOT NULL, DROP author_id');
    }
}
