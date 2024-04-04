<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240404014132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket_enchere (ticket_id INT AUTO_INCREMENT NOT NULL, enchere_id INT NOT NULL, prix NUMERIC(10, 0) NOT NULL, PRIMARY KEY(ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticketp (ticketp_id INT AUTO_INCREMENT NOT NULL, ticket_id INT NOT NULL, client_id INT NOT NULL, enchere_id INT NOT NULL, PRIMARY KEY(ticketp_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY fk_depot');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY fk_user');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE depot');
        $this->addSql('DROP TABLE detailscommande');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE discount CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE enchere CHANGE date_debut date_debut VARCHAR(255) NOT NULL, CHANGE heured heured VARCHAR(255) NOT NULL, CHANGE date_fin date_fin VARCHAR(255) NOT NULL, CHANGE heuref heuref VARCHAR(255) NOT NULL, CHANGE montant_initial montant_initial VARCHAR(255) NOT NULL, CHANGE montant_final montant_final VARCHAR(255) NOT NULL, CHANGE idclenchere idclenchere VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE grosmots CHANGE GrosMots grosmots VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, cmd_client INT NOT NULL, cmd_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentaire (id_com INT AUTO_INCREMENT NOT NULL, id_pub INT NOT NULL, id_client INT NOT NULL, contenu VARCHAR(5000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_com DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX fk_commentaire_user (id_client), INDEX fk_commentaire_id_pub (id_pub), PRIMARY KEY(id_com)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE depot (iddepot INT AUTO_INCREMENT NOT NULL, nomdepot VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(iddepot)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE detailscommande (id INT AUTO_INCREMENT NOT NULL, id_com INT NOT NULL, num_article INT NOT NULL, nom_article VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, quantite INT NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, sous_total DOUBLE PRECISION NOT NULL, INDEX id_com (id_com), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, iddepott INT DEFAULT NULL, idclient INT DEFAULT NULL, adresselivraison VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, datecommande DATETIME NOT NULL, datelivraison DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, statuslivraison VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, INDEX fk_user (idclient), INDEX fk_depot (iddepott), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit (id_p INT AUTO_INCREMENT NOT NULL, id_c INT NOT NULL, id_client INT NOT NULL, nom_p VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description_p VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prix_p DOUBLE PRECISION NOT NULL, image_p VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX id_c (id_c), INDEX id_client (id_client), PRIMARY KEY(id_p)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE publication (id_pub INT AUTO_INCREMENT NOT NULL, id_client INT NOT NULL, contenu VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nb_likes INT NOT NULL, nb_dislike INT NOT NULL, date_pub DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, photo VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_publication_user (id_client), PRIMARY KEY(id_pub)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rating (rating_id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, product_id INT DEFAULT NULL, rating_value INT DEFAULT NULL, INDEX user_id (user_id), INDEX product_id (product_id), PRIMARY KEY(rating_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, status TINYINT(1) DEFAULT NULL, nom VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, verificationCode VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, role VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT fk_depot FOREIGN KEY (iddepott) REFERENCES depot (iddepot)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT fk_user FOREIGN KEY (idclient) REFERENCES user (id)');
        $this->addSql('DROP TABLE ticket_enchere');
        $this->addSql('DROP TABLE ticketp');
        $this->addSql('ALTER TABLE discount CHANGE date date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL');
        $this->addSql('ALTER TABLE enchere CHANGE idclenchere idclenchere INT DEFAULT NULL, CHANGE date_debut date_debut VARCHAR(255) DEFAULT NULL, CHANGE heured heured VARCHAR(5) NOT NULL, CHANGE date_fin date_fin VARCHAR(255) DEFAULT NULL, CHANGE heuref heuref VARCHAR(5) NOT NULL, CHANGE montant_initial montant_initial VARCHAR(255) DEFAULT NULL, CHANGE montant_final montant_final VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE grosmots CHANGE grosmots GrosMots VARCHAR(1000) NOT NULL');
    }
}
