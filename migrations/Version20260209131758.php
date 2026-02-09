<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260209131758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '03. Fix fields from children, institution_groups and news tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE children DROP description');
        $this->addSql('ALTER TABLE institution_groups DROP address, DROP longitude, DROP latitude');
        $this->addSql('ALTER TABLE news ADD date_publication DATETIME NOT NULL, CHANGE description description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE news DROP date_publication, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE institution_groups ADD address VARCHAR(1024) NOT NULL, ADD longitude DOUBLE PRECISION DEFAULT NULL, ADD latitude DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE children ADD description VARCHAR(255) NOT NULL');
    }
}
