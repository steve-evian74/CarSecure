<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180821130043 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fk_upload_image2 (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE upload_image ADD fk_voiture2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE upload_image ADD CONSTRAINT FK_EC604940869AF573 FOREIGN KEY (fk_voiture2_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_EC604940869AF573 ON upload_image (fk_voiture2_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE fk_upload_image2');
        $this->addSql('ALTER TABLE upload_image DROP FOREIGN KEY FK_EC604940869AF573');
        $this->addSql('DROP INDEX IDX_EC604940869AF573 ON upload_image');
        $this->addSql('ALTER TABLE upload_image DROP fk_voiture2_id');
    }
}
