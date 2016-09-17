<?php

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160915103019 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE traject_geometry_point DROP FOREIGN KEY FK_C7441103A0CADD4');
        $this->addSql('ALTER TABLE traject_status DROP FOREIGN KEY FK_9C39D253A0CADD4');
        $this->addSql('ALTER TABLE traject CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE traject_geometry_point CHANGE traject_id traject_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE traject_status CHANGE traject_id traject_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE traject_geometry_point ADD CONSTRAINT FK_C7441103A0CADD4 FOREIGN KEY (traject_id) REFERENCES traject (id)');
        $this->addSql('ALTER TABLE traject_status ADD CONSTRAINT FK_9C39D253A0CADD4 FOREIGN KEY (traject_id) REFERENCES traject (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE traject_geometry_point DROP FOREIGN KEY FK_C7441103A0CADD4');
        $this->addSql('ALTER TABLE traject_status DROP FOREIGN KEY FK_9C39D253A0CADD4');
        $this->addSql('ALTER TABLE traject CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE traject_geometry_point CHANGE traject_id traject_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE traject_status CHANGE traject_id traject_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE traject_geometry_point ADD CONSTRAINT FK_C7441103A0CADD4 FOREIGN KEY (traject_id) REFERENCES traject (id)');
        $this->addSql('ALTER TABLE traject_status ADD CONSTRAINT FK_9C39D253A0CADD4 FOREIGN KEY (traject_id) REFERENCES traject (id)');
    }
}
