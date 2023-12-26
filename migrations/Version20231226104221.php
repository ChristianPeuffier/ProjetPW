<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231226104221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612BCF5E72D');
        $this->addSql('DROP INDEX UNIQ_3B755612BCF5E72D ON licencie');
        $this->addSql('ALTER TABLE licencie DROP categorie_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE licencie ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3B755612BCF5E72D ON licencie (categorie_id)');
    }
}
