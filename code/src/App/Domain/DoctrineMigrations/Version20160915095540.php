<?php

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160915095540 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE traject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, length INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traject_geometry_point (id INT AUTO_INCREMENT NOT NULL, traject_id INT DEFAULT NULL, position INT NOT NULL, latitude NUMERIC(11, 8) DEFAULT NULL, longitude NUMERIC(11, 8) DEFAULT NULL, INDEX IDX_C7441103A0CADD4 (traject_id), INDEX position_idx (position), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traject_status (id INT AUTO_INCREMENT NOT NULL, traject_id INT DEFAULT NULL, velocity INT NOT NULL, traveltime INT NOT NULL, measured_at DATETIME NOT NULL, INDEX IDX_9C39D253A0CADD4 (traject_id), INDEX measured_at_idx (measured_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
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
        $this->addSql('DROP TABLE traject');
        $this->addSql('DROP TABLE traject_geometry_point');
        $this->addSql('DROP TABLE traject_status');
    }
}
