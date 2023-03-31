<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330141751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, role, password, prenom, nom, adresse, ville, code_postal, pays, wishlist FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, wishlist CLOB DEFAULT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO user (id, email, roles, password, prenom, nom, adresse, ville, code_postal, pays, wishlist) SELECT id, email, role, password, prenom, nom, adresse, ville, code_postal, pays, wishlist FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, prenom, nom, adresse, ville, code_postal, pays, wishlist FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, role CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, wishlist CLOB DEFAULT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO user (id, email, role, password, prenom, nom, adresse, ville, code_postal, pays, wishlist) SELECT id, email, roles, password, prenom, nom, adresse, ville, code_postal, pays, wishlist FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
