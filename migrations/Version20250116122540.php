<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116122540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD stock_xs INT DEFAULT 0 NOT NULL, ADD stock_s INT DEFAULT 0 NOT NULL, ADD stock_m INT DEFAULT 0 NOT NULL, ADD stock_l INT DEFAULT 0 NOT NULL, ADD stock_xl INT DEFAULT 0 NOT NULL, ADD highlight TINYINT(1) DEFAULT 0 NOT NULL, ADD image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP stock_xs, DROP stock_s, DROP stock_m, DROP stock_l, DROP stock_xl, DROP highlight, DROP image');
    }
}
