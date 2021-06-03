<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210603111736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE annonce_categorie (annonce_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_3C5A3DA68805AB2F (annonce_id), INDEX IDX_3C5A3DA6BCF5E72D (categorie_id), PRIMARY KEY(annonce_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce_categorie ADD CONSTRAINT FK_3C5A3DA68805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_categorie ADD CONSTRAINT FK_3C5A3DA6BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce ADD id_recriteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5B3DD08E7 FOREIGN KEY (id_recriteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5B3DD08E7 ON annonce (id_recriteur_id)');
        $this->addSql('ALTER TABLE condidature ADD id_condidat_id INT NOT NULL');
        $this->addSql('ALTER TABLE condidature ADD CONSTRAINT FK_FDF2E30BE0B16C6 FOREIGN KEY (id_condidat_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FDF2E30BE0B16C6 ON condidature (id_condidat_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE annonce_categorie');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5B3DD08E7');
        $this->addSql('DROP INDEX IDX_F65593E5B3DD08E7 ON annonce');
        $this->addSql('ALTER TABLE annonce DROP id_recriteur_id');
        $this->addSql('ALTER TABLE condidature DROP FOREIGN KEY FK_FDF2E30BE0B16C6');
        $this->addSql('DROP INDEX IDX_FDF2E30BE0B16C6 ON condidature');
        $this->addSql('ALTER TABLE condidature DROP id_condidat_id');
    }
}
