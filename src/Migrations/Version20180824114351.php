<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180824114351 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet_entretien ADD fkvoiture1_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE carnet_entretien ADD CONSTRAINT FK_83A768F56EFCCC42 FOREIGN KEY (fkvoiture1_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_83A768F56EFCCC42 ON carnet_entretien (fkvoiture1_id)');
        $this->addSql('ALTER TABLE voiture CHANGE immatriculation immatriculation VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet_entretien DROP FOREIGN KEY FK_83A768F56EFCCC42');
        $this->addSql('DROP INDEX IDX_83A768F56EFCCC42 ON carnet_entretien');
        $this->addSql('ALTER TABLE carnet_entretien DROP fkvoiture1_id');
        $this->addSql('ALTER TABLE voiture CHANGE immatriculation immatriculation VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
