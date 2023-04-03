<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403101143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_produit_taille (id INT AUTO_INCREMENT NOT NULL, id_commande_id INT NOT NULL, id_prod_taille_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_44594FD89AF8E3A3 (id_commande_id), INDEX IDX_44594FD837E200F9 (id_prod_taille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, montant INT NOT NULL, statut VARCHAR(255) NOT NULL, date_commande DATETIME NOT NULL, INDEX IDX_35D4282C9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, sujet VARCHAR(100) DEFAULT NULL, message LONGTEXT NOT NULL, date_crea DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marques (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_crea DATETIME DEFAULT NULL, logo LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, slug LONGTEXT NOT NULL, categorie VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix INT NOT NULL, photo_url LONGTEXT DEFAULT NULL, couleur VARCHAR(255) DEFAULT NULL, ref VARCHAR(255) NOT NULL, INDEX IDX_BE2DDF8C4827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille_stock (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT NOT NULL, taille VARCHAR(255) NOT NULL, stock INT DEFAULT NULL, INDEX IDX_7460A5FFAABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles ARRAY NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, wishlist LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_produit_taille ADD CONSTRAINT FK_44594FD89AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE commande_produit_taille ADD CONSTRAINT FK_44594FD837E200F9 FOREIGN KEY (id_prod_taille_id) REFERENCES taille_stock (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C4827B9B2 FOREIGN KEY (marque_id) REFERENCES marques (id)');
        $this->addSql('ALTER TABLE taille_stock ADD CONSTRAINT FK_7460A5FFAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produits (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_produit_taille DROP FOREIGN KEY FK_44594FD89AF8E3A3');
        $this->addSql('ALTER TABLE commande_produit_taille DROP FOREIGN KEY FK_44594FD837E200F9');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C9D86650F');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C4827B9B2');
        $this->addSql('ALTER TABLE taille_stock DROP FOREIGN KEY FK_7460A5FFAABEFE2C');
        $this->addSql('DROP TABLE commande_produit_taille');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE marques');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE taille_stock');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
