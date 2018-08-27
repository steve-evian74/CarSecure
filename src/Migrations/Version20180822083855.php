<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180822083855 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intervention ADD fk_categorie_intervention_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABE8C8B132 FOREIGN KEY (fk_categorie_intervention_id) REFERENCES categorie_intervention (id)');
        $this->addSql('CREATE INDEX IDX_D11814ABE8C8B132 ON intervention (fk_categorie_intervention_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814ABE8C8B132');
        $this->addSql('DROP INDEX IDX_D11814ABE8C8B132 ON intervention');
        $this->addSql('ALTER TABLE intervention DROP fk_categorie_intervention_id');
    }
}
