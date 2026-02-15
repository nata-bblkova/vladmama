<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260218005252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '07. Add users table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users (
            username VARCHAR(180) NOT NULL, 
            username_canonical VARCHAR(180) NOT NULL, 
            email VARCHAR(180) NOT NULL, 
            email_canonical VARCHAR(180) NOT NULL, 
            enabled TINYINT NOT NULL, 
            salt VARCHAR(255) DEFAULT NULL, 
            password VARCHAR(255) NOT NULL, 
            last_login DATETIME DEFAULT NULL, 
            confirmation_token VARCHAR(180) DEFAULT NULL, 
            password_requested_at DATETIME DEFAULT NULL, 
            roles JSON NOT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            firstname VARCHAR(255) DEFAULT NULL, 
            lastname VARCHAR(255) DEFAULT NULL, 
            middlename VARCHAR(255) DEFAULT NULL, 
            id INT AUTO_INCREMENT NOT NULL, 
            UNIQUE INDEX UNIQ_1483A5E992FC23A8 (username_canonical), 
            UNIQUE INDEX UNIQ_1483A5E9A0D96FBF (email_canonical), 
            UNIQUE INDEX UNIQ_1483A5E9C05FB297 (confirmation_token), 
            PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}
