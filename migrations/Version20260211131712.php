<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260211131712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '03. Create media__galleries, media__gallery_item and media__medias tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE media__galleries (
            name VARCHAR(255) NOT NULL, 
            context VARCHAR(64) NOT NULL, 
            default_format VARCHAR(255) NOT NULL, 
            enabled TINYINT NOT NULL, 
            updated_at DATETIME NOT NULL, 
            created_at DATETIME NOT NULL, 
            unique_key VARCHAR(128) NOT NULL, 
            id INT AUTO_INCREMENT NOT NULL, 
            UNIQUE INDEX UNIQ_B0B7013EE721593 (unique_key), 
            PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4'
        );
        $this->addSql('CREATE TABLE media__gallery_item (
            id INT AUTO_INCREMENT NOT NULL, 
            media_id INT DEFAULT NULL, 
            gallery_id INT NOT NULL, 
            UNIQUE INDEX UNIQ_3238519AEA9FDD75 (media_id), 
            INDEX IDX_3238519A4E7AF8F (gallery_id), 
            PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4'
        );
        $this->addSql('CREATE TABLE media__medias (
             name VARCHAR(255) NOT NULL, 
             description TEXT DEFAULT NULL,
             enabled TINYINT NOT NULL, 
             provider_name VARCHAR(255) NOT NULL, 
             provider_status INT NOT NULL, 
             provider_reference VARCHAR(255) NOT NULL, 
             provider_metadata JSON DEFAULT NULL, 
             width INT DEFAULT NULL, 
             height INT DEFAULT NULL, 
             length NUMERIC(10, 0) DEFAULT NULL, 
             content_type VARCHAR(255) DEFAULT NULL, 
             content_size BIGINT DEFAULT NULL, 
             copyright VARCHAR(255) DEFAULT NULL, 
             author_name VARCHAR(255) DEFAULT NULL, 
             context VARCHAR(64) DEFAULT NULL, 
             cdn_is_flushable TINYINT NOT NULL, 
             cdn_flush_identifier VARCHAR(64) DEFAULT NULL, 
             cdn_flush_at DATETIME DEFAULT NULL, 
             cdn_status INT DEFAULT NULL, 
             updated_at DATETIME NOT NULL, 
             created_at DATETIME NOT NULL, 
             id INT AUTO_INCREMENT NOT NULL, 
             PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4'
        );
        $this->addSql('ALTER TABLE media__gallery_item ADD CONSTRAINT FK_3238519AEA9FDD75 FOREIGN KEY (media_id) REFERENCES media__medias (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media__gallery_item ADD CONSTRAINT FK_3238519A4E7AF8F FOREIGN KEY (gallery_id) REFERENCES media__galleries (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media__gallery_item DROP FOREIGN KEY FK_3238519AEA9FDD75');
        $this->addSql('ALTER TABLE media__gallery_item DROP FOREIGN KEY FK_3238519A4E7AF8F');
        $this->addSql('DROP TABLE media__galleries');
        $this->addSql('DROP TABLE media__gallery_item');
        $this->addSql('DROP TABLE media__medias');
    }
}
