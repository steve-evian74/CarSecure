<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180821124118 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet_entretien ADD fk_user_garage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE carnet_entretien ADD CONSTRAINT FK_83A768F5B1119158 FOREIGN KEY (fk_user_garage_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_83A768F5B1119158 ON carnet_entretien (fk_user_garage_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet_entretien DROP FOREIGN KEY FK_83A768F5B1119158');
        $this->addSql('DROP INDEX IDX_83A768F5B1119158 ON carnet_entretien');
        $this->addSql('ALTER TABLE carnet_entretien DROP fk_user_garage_id');
    }
}
