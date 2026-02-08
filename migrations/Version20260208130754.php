<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260208130754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '02. Add timestampable fields to categories, children, institution_groups, institutions and news tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE categories ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE children ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE institution_groups ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE institutions ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE news ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE categories DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE news DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE institutions DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE children DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE institution_groups DROP created_at, DROP updated_at');
    }
}
