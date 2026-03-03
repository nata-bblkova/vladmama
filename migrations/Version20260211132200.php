<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260211132200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '04. Add image to categories, institutions and news tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE categories ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF346683DA5256D FOREIGN KEY (image_id) REFERENCES media__medias (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AF346683DA5256D ON categories (image_id)');
        $this->addSql('ALTER TABLE institutions ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE institutions ADD CONSTRAINT FK_CB5446643DA5256D FOREIGN KEY (image_id) REFERENCES media__medias (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CB5446643DA5256D ON institutions (image_id)');
        $this->addSql('ALTER TABLE news ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD399503DA5256D FOREIGN KEY (image_id) REFERENCES media__medias (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1DD399503DA5256D ON news (image_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF346683DA5256D');
        $this->addSql('DROP INDEX UNIQ_3AF346683DA5256D ON categories');
        $this->addSql('ALTER TABLE categories DROP image_id');
        $this->addSql('ALTER TABLE institutions DROP FOREIGN KEY FK_CB5446643DA5256D');
        $this->addSql('DROP INDEX UNIQ_CB5446643DA5256D ON institutions');
        $this->addSql('ALTER TABLE institutions DROP image_id');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD399503DA5256D');
        $this->addSql('DROP INDEX UNIQ_1DD399503DA5256D ON news');
        $this->addSql('ALTER TABLE news DROP image_id');
    }
}
