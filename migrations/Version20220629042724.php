<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629042724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis_plat (id INT AUTO_INCREMENT NOT NULL, commentaires LONGTEXT DEFAULT NULL, note DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis_restaurant (id INT AUTO_INCREMENT NOT NULL, restaurants_id INT DEFAULT NULL, commentaires LONGTEXT DEFAULT NULL, note DOUBLE PRECISION DEFAULT NULL, INDEX IDX_750B5064DCA160A (restaurants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_menu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images_menu (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, INDEX IDX_470B0B6CCCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images_restaurant (id INT AUTO_INCREMENT NOT NULL, restaurants_id INT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, INDEX IDX_5A333FB04DCA160A (restaurants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, restaurants_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, description_plat LONGTEXT DEFAULT NULL, INDEX IDX_7D053A934DCA160A (restaurants_id), INDEX IDX_7D053A93BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurants (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, chef VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `table` (id INT AUTO_INCREMENT NOT NULL, restaurants_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, capacite INT DEFAULT NULL, INDEX IDX_F6298F464DCA160A (restaurants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis_restaurant ADD CONSTRAINT FK_750B5064DCA160A FOREIGN KEY (restaurants_id) REFERENCES restaurants (id)');
        $this->addSql('ALTER TABLE images_menu ADD CONSTRAINT FK_470B0B6CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE images_restaurant ADD CONSTRAINT FK_5A333FB04DCA160A FOREIGN KEY (restaurants_id) REFERENCES restaurants (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A934DCA160A FOREIGN KEY (restaurants_id) REFERENCES restaurants (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_menu (id)');
        $this->addSql('ALTER TABLE `table` ADD CONSTRAINT FK_F6298F464DCA160A FOREIGN KEY (restaurants_id) REFERENCES restaurants (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93BCF5E72D');
        $this->addSql('ALTER TABLE images_menu DROP FOREIGN KEY FK_470B0B6CCCD7E912');
        $this->addSql('ALTER TABLE avis_restaurant DROP FOREIGN KEY FK_750B5064DCA160A');
        $this->addSql('ALTER TABLE images_restaurant DROP FOREIGN KEY FK_5A333FB04DCA160A');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A934DCA160A');
        $this->addSql('ALTER TABLE `table` DROP FOREIGN KEY FK_F6298F464DCA160A');
        $this->addSql('DROP TABLE avis_plat');
        $this->addSql('DROP TABLE avis_restaurant');
        $this->addSql('DROP TABLE categorie_menu');
        $this->addSql('DROP TABLE images_menu');
        $this->addSql('DROP TABLE images_restaurant');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE restaurants');
        $this->addSql('DROP TABLE `table`');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
