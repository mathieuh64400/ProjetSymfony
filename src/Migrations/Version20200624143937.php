<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624143937 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE paie_commande ADD civilite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paie_commande ADD CONSTRAINT FK_BC038A5B39194ABF FOREIGN KEY (civilite_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BC038A5B39194ABF ON paie_commande (civilite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE paie_commande DROP FOREIGN KEY FK_BC038A5B39194ABF');
        $this->addSql('DROP INDEX IDX_BC038A5B39194ABF ON paie_commande');
        $this->addSql('ALTER TABLE paie_commande DROP civilite_id');
    }
}
