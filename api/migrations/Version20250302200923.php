<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250302200923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE order_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE orders_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE orders (id INT NOT NULL, product_id INT NOT NULL, owner_id INT NOT NULL, quantity INT NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E52FFDEE4584665A ON orders (product_id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE7E3C61F9 ON orders (owner_id)');
        $this->addSql('COMMENT ON COLUMN orders.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN orders.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT fk_f52993984584665a');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT fk_f52993987e3c61f9');
        $this->addSql('DROP TABLE "order"');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE orders_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, product_id INT NOT NULL, owner_id INT NOT NULL, quantity INT NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_f52993987e3c61f9 ON "order" (owner_id)');
        $this->addSql('CREATE INDEX idx_f52993984584665a ON "order" (product_id)');
        $this->addSql('COMMENT ON COLUMN "order".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "order".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f52993984584665a FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f52993987e3c61f9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEE4584665A');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEE7E3C61F9');
        $this->addSql('DROP TABLE orders');
    }
}
