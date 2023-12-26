<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231226202232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_3B7556128F2174D8 ON licencie');
        $this->addSql('ALTER TABLE licencie CHANGE numéro_licence numero_licence SMALLINT NOT NULL, CHANGE prénom prenom VARCHAR(50) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3B755612DBFEF8E9 ON licencie (numero_licence)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_3B755612DBFEF8E9 ON licencie');
        $this->addSql('ALTER TABLE licencie CHANGE numero_licence numéro_licence SMALLINT NOT NULL, CHANGE prenom prénom VARCHAR(50) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3B7556128F2174D8 ON licencie (numéro_licence)');
    }
}
