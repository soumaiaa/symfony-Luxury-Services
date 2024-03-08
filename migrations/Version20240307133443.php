<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307133443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidats (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, photo_id INT DEFAULT NULL, passeport_id INT DEFAULT NULL, cv_id INT DEFAULT NULL, gender_id INT DEFAULT NULL, experience_id INT DEFAULT NULL, interest_job_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, nationalite VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, birthplace VARCHAR(255) NOT NULL, current_location VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3C663B15A76ED395 (user_id), UNIQUE INDEX UNIQ_3C663B157E9E4C8C (photo_id), UNIQUE INDEX UNIQ_3C663B15691B94D5 (passeport_id), UNIQUE INDEX UNIQ_3C663B15CFE419E2 (cv_id), INDEX IDX_3C663B15708A0E0 (gender_id), INDEX IDX_3C663B1546E90E27 (experience_id), INDEX IDX_3C663B15716EB4E0 (interest_job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidatures (id INT AUTO_INCREMENT NOT NULL, candidat_id INT DEFAULT NULL, offre_id INT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_DE57CF668D0EB82 (candidat_id), INDEX IDX_DE57CF664CC8505A (offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, societe VARCHAR(255) NOT NULL, nom_contact VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, experience VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, gender VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offres (id INT AUTO_INCREMENT NOT NULL, typecontract_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, client_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, starting_date DATE NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', position VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, salaire INT NOT NULL, ref VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, date_cloture VARCHAR(255) NOT NULL, INDEX IDX_C6AC35445B3EC6A0 (typecontract_id), INDEX IDX_C6AC3544BCF5E72D (categorie_id), INDEX IDX_C6AC354419EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_contract (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B157E9E4C8C FOREIGN KEY (photo_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15691B94D5 FOREIGN KEY (passeport_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15CFE419E2 FOREIGN KEY (cv_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B1546E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15716EB4E0 FOREIGN KEY (interest_job_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF668D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidats (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF664CC8505A FOREIGN KEY (offre_id) REFERENCES offres (id)');
        $this->addSql('ALTER TABLE offres ADD CONSTRAINT FK_C6AC35445B3EC6A0 FOREIGN KEY (typecontract_id) REFERENCES type_contract (id)');
        $this->addSql('ALTER TABLE offres ADD CONSTRAINT FK_C6AC3544BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE offres ADD CONSTRAINT FK_C6AC354419EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('DROP TABLE messenger_messages');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15A76ED395');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B157E9E4C8C');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15691B94D5');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15CFE419E2');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15708A0E0');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B1546E90E27');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15716EB4E0');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF668D0EB82');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF664CC8505A');
        $this->addSql('ALTER TABLE offres DROP FOREIGN KEY FK_C6AC35445B3EC6A0');
        $this->addSql('ALTER TABLE offres DROP FOREIGN KEY FK_C6AC3544BCF5E72D');
        $this->addSql('ALTER TABLE offres DROP FOREIGN KEY FK_C6AC354419EB6921');
        $this->addSql('DROP TABLE candidats');
        $this->addSql('DROP TABLE candidatures');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE offres');
        $this->addSql('DROP TABLE type_contract');
    }
}
