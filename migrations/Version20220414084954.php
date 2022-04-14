<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414084954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, published_date DATETIME NOT NULL, INDEX IDX_BFDD3168A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles_categories (articles_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_DE004A0E1EBAF6CC (articles_id), INDEX IDX_DE004A0EA21214B7 (categories_id), PRIMARY KEY(articles_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(63) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE articles_categories ADD CONSTRAINT FK_DE004A0E1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_categories ADD CONSTRAINT FK_DE004A0EA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_categories DROP FOREIGN KEY FK_DE004A0E1EBAF6CC');
        $this->addSql('ALTER TABLE articles_categories DROP FOREIGN KEY FK_DE004A0EA21214B7');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE articles_categories');
        $this->addSql('DROP TABLE categories');
    }
}
