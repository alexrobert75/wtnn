<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322105801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__produits AS SELECT id, marque_id, nom, slug, categorie, description, prix, photo_url, couleur, ref FROM produits');
        $this->addSql('DROP TABLE produits');
        $this->addSql('CREATE TABLE produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, marque_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, slug CLOB NOT NULL, categorie VARCHAR(255) NOT NULL, description CLOB NOT NULL, prix INTEGER NOT NULL, photo_url CLOB DEFAULT NULL, couleur VARCHAR(255) DEFAULT NULL, ref VARCHAR(255) NOT NULL, CONSTRAINT FK_BE2DDF8C4827B9B2 FOREIGN KEY (marque_id) REFERENCES marques (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO produits (id, marque_id, nom, slug, categorie, description, prix, photo_url, couleur, ref) SELECT id, marque_id, nom, slug, categorie, description, prix, photo_url, couleur, ref FROM __temp__produits');
        $this->addSql('DROP TABLE __temp__produits');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C4827B9B2 ON produits (marque_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__produits AS SELECT id, marque_id, nom, slug, categorie, description, prix, photo_url, couleur, ref FROM produits');
        $this->addSql('DROP TABLE produits');
        $this->addSql('CREATE TABLE produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, marque_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, slug CLOB NOT NULL, categorie VARCHAR(255) NOT NULL, description CLOB NOT NULL, prix INTEGER NOT NULL, photo_url CLOB DEFAULT NULL, couleur VARCHAR(255) DEFAULT NULL, ref VARCHAR(255) NOT NULL, CONSTRAINT FK_BE2DDF8C4827B9B2 FOREIGN KEY (marque_id) REFERENCES marques (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO produits (id, marque_id, nom, slug, categorie, description, prix, photo_url, couleur, ref) SELECT id, marque_id, nom, slug, categorie, description, prix, photo_url, couleur, ref FROM __temp__produits');
        $this->addSql('DROP TABLE __temp__produits');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C4827B9B2 ON produits (marque_id)');
    }
}
