<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221020150533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3351CA68B1');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3351CA68B1 FOREIGN KEY (class_roo_m_id) REFERENCES class_roo_m (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3351CA68B1');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3351CA68B1 FOREIGN KEY (class_roo_m_id) REFERENCES class_roo_m (id)');
    }
}
