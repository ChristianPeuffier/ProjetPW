<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240102212516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE educateur DROP FOREIGN KEY FK_763C0122B56DCD74');
        $this->addSql('DROP INDEX UNIQ_763C0122B56DCD74 ON educateur');
        $this->addSql('ALTER TABLE educateur DROP licencie_id');
        $this->addSql('ALTER TABLE licencie ADD educateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B7556126BFC1A0E FOREIGN KEY (educateur_id) REFERENCES educateur (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3B7556126BFC1A0E ON licencie (educateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE educateur ADD licencie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE educateur ADD CONSTRAINT FK_763C0122B56DCD74 FOREIGN KEY (licencie_id) REFERENCES licencie (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_763C0122B56DCD74 ON educateur (licencie_id)');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B7556126BFC1A0E');
        $this->addSql('DROP INDEX UNIQ_3B7556126BFC1A0E ON licencie');
        $this->addSql('ALTER TABLE licencie DROP educateur_id');
    }
}
