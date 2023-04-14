<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230413140026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'fill data';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO item (name, price) VALUES('earphones', 10000)");
        $this->addSql("INSERT INTO item (name, price) VALUES('phone case', 2000)");
        $this->addSql("INSERT INTO country (name, vat, sku_prefix) VALUES('Germany', 1900, 'DE')");
        $this->addSql("INSERT INTO country (name, vat, sku_prefix) VALUES('Italy', 2200, 'IT')");
        $this->addSql("INSERT INTO country (name, vat, sku_prefix) VALUES('Greece', 2400, 'GR')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM country');
        $this->addSql('DELETE FROM item');
    }
}
