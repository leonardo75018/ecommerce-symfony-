<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428122947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket_product (basket_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_17ED14B41BE1FB52 (basket_id), INDEX IDX_17ED14B44584665A (product_id), PRIMARY KEY(basket_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, basket_total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE basket_product ADD CONSTRAINT FK_17ED14B41BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE basket_product ADD CONSTRAINT FK_17ED14B44584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B4D4CFF2B');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B79D0C0E4');
        $this->addSql('DROP INDEX IDX_2246507B4D4CFF2B ON basket');
        $this->addSql('DROP INDEX IDX_2246507B79D0C0E4 ON basket');
        $this->addSql('ALTER TABLE basket ADD basket_total DOUBLE PRECISION NOT NULL, DROP shipping_address_id, DROP billing_address_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket_product DROP FOREIGN KEY FK_17ED14B41BE1FB52');
        $this->addSql('ALTER TABLE basket_product DROP FOREIGN KEY FK_17ED14B44584665A');
        $this->addSql('DROP TABLE basket_product');
        $this->addSql('DROP TABLE cart');
        $this->addSql('ALTER TABLE basket ADD shipping_address_id INT DEFAULT NULL, ADD billing_address_id INT DEFAULT NULL, DROP basket_total');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B4D4CFF2B FOREIGN KEY (shipping_address_id) REFERENCES shipping_address (id)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B79D0C0E4 FOREIGN KEY (billing_address_id) REFERENCES billing_address (id)');
        $this->addSql('CREATE INDEX IDX_2246507B4D4CFF2B ON basket (shipping_address_id)');
        $this->addSql('CREATE INDEX IDX_2246507B79D0C0E4 ON basket (billing_address_id)');
    }
}
