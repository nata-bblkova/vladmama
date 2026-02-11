<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260211131554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '01. Create children, institution_groups and institutions tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE children (name VARCHAR(255) NOT NULL, desire VARCHAR(255) DEFAULT NULL, birthday DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, id INT AUTO_INCREMENT NOT NULL, group_id INT DEFAULT NULL, institution_id INT DEFAULT NULL, INDEX IDX_A197B1BAFE54D947 (group_id), INDEX IDX_A197B1BA10405986 (institution_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE institution_groups (name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, id INT AUTO_INCREMENT NOT NULL, institution_id INT NOT NULL, INDEX IDX_65336B6910405986 (institution_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE institutions (name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, address VARCHAR(1024) NOT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE children ADD CONSTRAINT FK_A197B1BAFE54D947 FOREIGN KEY (group_id) REFERENCES institution_groups (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE children ADD CONSTRAINT FK_A197B1BA10405986 FOREIGN KEY (institution_id) REFERENCES institutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE institution_groups ADD CONSTRAINT FK_65336B6910405986 FOREIGN KEY (institution_id) REFERENCES institutions (id) ON DELETE RESTRICT');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE children DROP FOREIGN KEY FK_A197B1BAFE54D947');
        $this->addSql('ALTER TABLE children DROP FOREIGN KEY FK_A197B1BA10405986');
        $this->addSql('ALTER TABLE institution_groups DROP FOREIGN KEY FK_65336B6910405986');
        $this->addSql('DROP TABLE children');
        $this->addSql('DROP TABLE institution_groups');
        $this->addSql('DROP TABLE institutions');
    }
}
