<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180822084521 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814ABE6BDA8C9');
        $this->addSql('DROP INDEX IDX_D11814ABE6BDA8C9 ON intervention');
        $this->addSql('ALTER TABLE intervention DROP fk_carnet_entretien_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intervention ADD fk_carnet_entretien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABE6BDA8C9 FOREIGN KEY (fk_carnet_entretien_id) REFERENCES carnet_entretien (id)');
        $this->addSql('CREATE INDEX IDX_D11814ABE6BDA8C9 ON intervention (fk_carnet_entretien_id)');
    }
}
