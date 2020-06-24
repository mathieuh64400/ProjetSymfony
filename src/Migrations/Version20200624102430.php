<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624102430 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choix_commande ADD nature_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choix_commande ADD CONSTRAINT FK_4715B31DEC6D5600 FOREIGN KEY (nature_commande_id) REFERENCES nature_commande (id)');
        $this->addSql('CREATE INDEX IDX_4715B31DEC6D5600 ON choix_commande (nature_commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choix_commande DROP FOREIGN KEY FK_4715B31DEC6D5600');
        $this->addSql('DROP INDEX IDX_4715B31DEC6D5600 ON choix_commande');
        $this->addSql('ALTER TABLE choix_commande DROP nature_commande_id');
    }
}
