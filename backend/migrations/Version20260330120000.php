<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260330120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Backfill NULL/empty user roles with ROLE_USER';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("UPDATE user SET roles = '[\"ROLE_USER\"]' WHERE roles IS NULL OR JSON_TYPE(roles) = 'NULL' OR roles = '[]'");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("UPDATE user SET roles = '[]' WHERE roles = '[\"ROLE_USER\"]'");
    }
}
