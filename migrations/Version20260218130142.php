<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260218130142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '08. Add gifts table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE gifts (
            description LONGTEXT NOT NULL, 
            gift_status_enum VARCHAR(255) NOT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            id INT AUTO_INCREMENT NOT NULL, 
            promotion_id INT NOT NULL, 
            child_id INT NOT NULL, 
            user_id INT DEFAULT NULL, 
            INDEX IDX_651BCF2F139DF194 (promotion_id), 
            INDEX IDX_651BCF2FDD62C21B (child_id), 
            INDEX IDX_651BCF2FA76ED395 (user_id), 
            UNIQUE INDEX unique_gifts_promotion_child (promotion_id, child_id), 
            PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4'
        );
        $this->addSql('ALTER TABLE gifts ADD CONSTRAINT FK_651BCF2F139DF194 FOREIGN KEY (promotion_id) REFERENCES promotions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gifts ADD CONSTRAINT FK_651BCF2FDD62C21B FOREIGN KEY (child_id) REFERENCES children (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE gifts ADD CONSTRAINT FK_651BCF2FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE gifts DROP FOREIGN KEY FK_651BCF2F139DF194');
        $this->addSql('ALTER TABLE gifts DROP FOREIGN KEY FK_651BCF2FDD62C21B');
        $this->addSql('ALTER TABLE gifts DROP FOREIGN KEY FK_651BCF2FA76ED395');
        $this->addSql('DROP TABLE gifts');
    }
}
