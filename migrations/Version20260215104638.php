<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260215104638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '06. Add promotions table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE promotions (
            name VARCHAR(255) NOT NULL, 
            description LONGTEXT NOT NULL, 
            rules LONGTEXT NOT NULL, 
            date_publication DATETIME NOT NULL, 
            start_date DATETIME NOT NULL, 
            end_date DATETIME NOT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            id INT AUTO_INCREMENT NOT NULL, 
            image_id INT DEFAULT NULL, 
            category_id INT NOT NULL, 
            UNIQUE INDEX UNIQ_EA1B30343DA5256D (image_id), 
            INDEX IDX_EA1B303412469DE2 (category_id), 
            PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4'
        );
        $this->addSql('CREATE TABLE promotion__institutions (promotion_id INT NOT NULL, institution_id INT NOT NULL, INDEX IDX_860A2B2139DF194 (promotion_id), INDEX IDX_860A2B210405986 (institution_id), PRIMARY KEY (promotion_id, institution_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B30343DA5256D FOREIGN KEY (image_id) REFERENCES media__medias (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B303412469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE promotion__institutions ADD CONSTRAINT FK_860A2B2139DF194 FOREIGN KEY (promotion_id) REFERENCES promotions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promotion__institutions ADD CONSTRAINT FK_860A2B210405986 FOREIGN KEY (institution_id) REFERENCES institutions (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B30343DA5256D');
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B303412469DE2');
        $this->addSql('ALTER TABLE promotion__institutions DROP FOREIGN KEY FK_860A2B2139DF194');
        $this->addSql('ALTER TABLE promotion__institutions DROP FOREIGN KEY FK_860A2B210405986');
        $this->addSql('DROP TABLE promotions');
        $this->addSql('DROP TABLE promotion__institutions');
    }
}
