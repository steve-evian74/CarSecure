<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180821125329 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE upload_image ADD fk_voiture_image_id INT NOT NULL');
        $this->addSql('ALTER TABLE upload_image ADD CONSTRAINT FK_EC604940A053B09B FOREIGN KEY (fk_voiture_image_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_EC604940A053B09B ON upload_image (fk_voiture_image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE upload_image DROP FOREIGN KEY FK_EC604940A053B09B');
        $this->addSql('DROP INDEX IDX_EC604940A053B09B ON upload_image');
        $this->addSql('ALTER TABLE upload_image DROP fk_voiture_image_id');
    }
}
