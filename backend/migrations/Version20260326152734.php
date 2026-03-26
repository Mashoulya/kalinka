<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260326152734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, author_first_name VARCHAR(100) NOT NULL, author_last_name VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(20) NOT NULL, content LONGTEXT NOT NULL, ip_address VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, total NUMERIC(10, 2) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, quantity SMALLINT NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, order_ref_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_52EA1F09E238517C (order_ref_id), INDEX IDX_52EA1F094584665A (product_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, file_data VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, product_id INT NOT NULL, INDEX IDX_14B784184584665A (product_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, price NUMERIC(10, 2) NOT NULL, weight_volume NUMERIC(10, 3) DEFAULT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, unit_id INT DEFAULT NULL, subcategory_id INT NOT NULL, INDEX IDX_D34A04ADF8BD700D (unit_id), INDEX IDX_D34A04AD5DC6FE57 (subcategory_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, external_id VARCHAR(32) NOT NULL, user_name VARCHAR(150) NOT NULL, is_positive TINYINT NOT NULL, rating SMALLINT NOT NULL, comment LONGTEXT NOT NULL, time DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE subcategory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, category_id INT NOT NULL, INDEX IDX_DDCA44812469DE2 (category_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, code VARCHAR(10) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, last_name VARCHAR(100) NOT NULL, first_name VARCHAR(100) NOT NULL, birth_date DATE NOT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(100) NOT NULL, phone VARCHAR(20) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649444F97DD (phone), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09E238517C FOREIGN KEY (order_ref_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F094584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784184584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA44812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F09E238517C');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F094584665A');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784184584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF8BD700D');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5DC6FE57');
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA44812469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE subcategory');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE user');
    }
}
