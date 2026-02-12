<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260212021640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE children DROP FOREIGN KEY `FK_A197B1BA10405986`');
        $this->addSql('DROP INDEX IDX_A197B1BA10405986 ON children');
        $this->addSql('ALTER TABLE children DROP institution_id, CHANGE birthday birthday DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE children ADD institution_id INT DEFAULT NULL, CHANGE birthday birthday DATETIME NOT NULL');
        $this->addSql('ALTER TABLE children ADD CONSTRAINT `FK_A197B1BA10405986` FOREIGN KEY (institution_id) REFERENCES institutions (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_A197B1BA10405986 ON children (institution_id)');
    }
}
