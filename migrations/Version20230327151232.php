<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327151232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_produit_taille (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_commande_id INTEGER NOT NULL, id_prod_taille_id INTEGER NOT NULL, quantite INTEGER NOT NULL, CONSTRAINT FK_44594FD89AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_44594FD837E200F9 FOREIGN KEY (id_prod_taille_id) REFERENCES taille_stock (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_44594FD89AF8E3A3 ON commande_produit_taille (id_commande_id)');
        $this->addSql('CREATE INDEX IDX_44594FD837E200F9 ON commande_produit_taille (id_prod_taille_id)');
        $this->addSql('DROP TABLE commandes_taille_stock');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commandes_taille_stock (commandes_id INTEGER NOT NULL, taille_stock_id INTEGER NOT NULL, PRIMARY KEY(commandes_id, taille_stock_id), CONSTRAINT FK_289E4A1B8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_289E4A1B461BD85D FOREIGN KEY (taille_stock_id) REFERENCES taille_stock (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_289E4A1B461BD85D ON commandes_taille_stock (taille_stock_id)');
        $this->addSql('CREATE INDEX IDX_289E4A1B8BF5C2E6 ON commandes_taille_stock (commandes_id)');
        $this->addSql('DROP TABLE commande_produit_taille');
    }
}
