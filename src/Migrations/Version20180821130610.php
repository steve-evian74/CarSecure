<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180821130610 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE upload_image DROP FOREIGN KEY FK_EC604940869AF573');
        $this->addSql('DROP INDEX IDX_EC604940869AF573 ON upload_image');
        $this->addSql('ALTER TABLE upload_image DROP fk_voiture2_id');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FA371893D');
        $this->addSql('DROP INDEX IDX_E9E2810FA371893D ON voiture');
        $this->addSql('ALTER TABLE voiture DROP fk_upload_image_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE upload_image ADD fk_voiture2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE upload_image ADD CONSTRAINT FK_EC604940869AF573 FOREIGN KEY (fk_voiture2_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_EC604940869AF573 ON upload_image (fk_voiture2_id)');
        $this->addSql('ALTER TABLE voiture ADD fk_upload_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FA371893D FOREIGN KEY (fk_upload_image_id) REFERENCES upload_image (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FA371893D ON voiture (fk_upload_image_id)');
    }
}
