<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260211131633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '02. Create categories and news tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE categories (
            name VARCHAR(255) NOT NULL, 
            description VARCHAR(255) NOT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            id INT AUTO_INCREMENT NOT NULL, 
            PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4'
        );
        $this->addSql('CREATE TABLE news (
            name VARCHAR(255) NOT NULL, 
            description LONGTEXT NOT NULL, 
            date_publication DATETIME NOT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            id INT AUTO_INCREMENT NOT NULL, 
            category_id INT NOT NULL, 
            INDEX IDX_1DD3995012469DE2 (category_id), 
            PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4'
        );
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD3995012469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE RESTRICT');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD3995012469DE2');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE news');
    }
}
