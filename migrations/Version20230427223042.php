<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427223042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket ADD shipping_address_id INT DEFAULT NULL, ADD billing_address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B4D4CFF2B FOREIGN KEY (shipping_address_id) REFERENCES shipping_address (id)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B79D0C0E4 FOREIGN KEY (billing_address_id) REFERENCES billing_address (id)');
        $this->addSql('CREATE INDEX IDX_2246507B4D4CFF2B ON basket (shipping_address_id)');
        $this->addSql('CREATE INDEX IDX_2246507B79D0C0E4 ON basket (billing_address_id)');
        $this->addSql('ALTER TABLE billing_address DROP INDEX UNIQ_6660E456A76ED395, ADD INDEX IDX_6660E456A76ED395 (user_id)');
        $this->addSql('ALTER TABLE shipping_address DROP INDEX UNIQ_EB066945A76ED395, ADD INDEX IDX_EB066945A76ED395 (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B4D4CFF2B');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B79D0C0E4');
        $this->addSql('DROP INDEX IDX_2246507B4D4CFF2B ON basket');
        $this->addSql('DROP INDEX IDX_2246507B79D0C0E4 ON basket');
        $this->addSql('ALTER TABLE basket DROP shipping_address_id, DROP billing_address_id');
        $this->addSql('ALTER TABLE billing_address DROP INDEX IDX_6660E456A76ED395, ADD UNIQUE INDEX UNIQ_6660E456A76ED395 (user_id)');
        $this->addSql('ALTER TABLE shipping_address DROP INDEX IDX_EB066945A76ED395, ADD UNIQUE INDEX UNIQ_EB066945A76ED395 (user_id)');
    }
}
