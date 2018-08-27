<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180824114642 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet_entretien ADD fk_voitrue_carn_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE carnet_entretien ADD CONSTRAINT FK_83A768F5CA742D3B FOREIGN KEY (fk_voitrue_carn_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_83A768F5CA742D3B ON carnet_entretien (fk_voitrue_carn_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet_entretien DROP FOREIGN KEY FK_83A768F5CA742D3B');
        $this->addSql('DROP INDEX IDX_83A768F5CA742D3B ON carnet_entretien');
        $this->addSql('ALTER TABLE carnet_entretien DROP fk_voitrue_carn_id');
    }
}
