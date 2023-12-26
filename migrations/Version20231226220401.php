<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231226220401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612E7A1254A');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612E7A1254A');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
