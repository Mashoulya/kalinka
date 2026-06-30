<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260630135000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "Add slug to product and subcategory";
    }

    public function up(Schema $schema): void
    {
        // category: slug column and index already exist, just ensure NOT NULL
        $this->addSql("UPDATE category SET slug = CONCAT(LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(name, ' ', '-'), 'é', 'e'), 'è', 'e'), 'à', 'a'), 'ç', 'c')), '-', id) WHERE slug IS NULL OR slug = ''");
        $this->addSql("ALTER TABLE category MODIFY slug VARCHAR(160) NOT NULL");

        // product
        $this->addSql('ALTER TABLE product ADD slug VARCHAR(160) DEFAULT NULL');
        $this->addSql("UPDATE product SET slug = CONCAT(LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(name, ' ', '-'), 'é', 'e'), 'è', 'e'), 'à', 'a'), 'ç', 'c')), '-', id)");
        $this->addSql("ALTER TABLE product MODIFY slug VARCHAR(160) NOT NULL");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_D34A04AD989D9B62 ON product (slug)");

        // subcategory
        $this->addSql('ALTER TABLE subcategory ADD slug VARCHAR(160) DEFAULT NULL');
        $this->addSql("UPDATE subcategory SET slug = CONCAT(LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(name, ' ', '-'), 'é', 'e'), 'è', 'e'), 'à', 'a'), 'ç', 'c')), '-', id)");
        $this->addSql("ALTER TABLE subcategory MODIFY slug VARCHAR(160) NOT NULL");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_DDCA448989D9B62 ON subcategory (slug)");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP INDEX UNIQ_64C19C1989D9B62 ON category");
        $this->addSql("ALTER TABLE category DROP slug");
        $this->addSql("DROP INDEX UNIQ_D34A04AD989D9B62 ON product");
        $this->addSql("ALTER TABLE product DROP slug");
        $this->addSql("DROP INDEX UNIQ_DDCA448989D9B62 ON subcategory");
        $this->addSql("ALTER TABLE subcategory DROP slug");
    }
}
