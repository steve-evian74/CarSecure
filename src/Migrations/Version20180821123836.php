<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180821123836 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet_entretien ADD fk_voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE carnet_entretien ADD CONSTRAINT FK_83A768F5F1EF6229 FOREIGN KEY (fk_voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_83A768F5F1EF6229 ON carnet_entretien (fk_voiture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet_entretien DROP FOREIGN KEY FK_83A768F5F1EF6229');
        $this->addSql('DROP INDEX IDX_83A768F5F1EF6229 ON carnet_entretien');
        $this->addSql('ALTER TABLE carnet_entretien DROP fk_voiture_id');
    }
}
