<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241222110340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE household (id SERIAL NOT NULL, name VARCHAR(100) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN household.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product (id SERIAL NOT NULL, code VARCHAR(10) NOT NULL, name VARCHAR(100) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_history (id SERIAL NOT NULL, product_id_id INT NOT NULL, price INT NOT NULL, date_from DATE NOT NULL, date_until DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F6636BFBDE18E50B ON product_history (product_id_id)');
        $this->addSql('COMMENT ON COLUMN product_history.date_from IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN product_history.date_until IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE registration (id SERIAL NOT NULL, product_history_id_id INT NOT NULL, user_id_id INT NOT NULL, registration_type VARCHAR(255) NOT NULL, registered_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62A8A7A7FC118AC2 ON registration (product_history_id_id)');
        $this->addSql('CREATE INDEX IDX_62A8A7A79D86650F ON registration (user_id_id)');
        $this->addSql('COMMENT ON COLUMN registration.registered_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE stock (id SERIAL NOT NULL, household_id_id INT NOT NULL, product_history_id_id INT NOT NULL, quantity INT NOT NULL, added_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4B365660A848132E ON stock (household_id_id)');
        $this->addSql('CREATE INDEX IDX_4B365660FC118AC2 ON stock (product_history_id_id)');
        $this->addSql('COMMENT ON COLUMN stock.added_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(100) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, household_roles TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON "user" (username)');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".household_roles IS \'(DC2Type:simple_array)\'');
        $this->addSql('ALTER TABLE product_history ADD CONSTRAINT FK_F6636BFBDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7FC118AC2 FOREIGN KEY (product_history_id_id) REFERENCES product_history (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A79D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660A848132E FOREIGN KEY (household_id_id) REFERENCES household (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660FC118AC2 FOREIGN KEY (product_history_id_id) REFERENCES product_history (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product_history DROP CONSTRAINT FK_F6636BFBDE18E50B');
        $this->addSql('ALTER TABLE registration DROP CONSTRAINT FK_62A8A7A7FC118AC2');
        $this->addSql('ALTER TABLE registration DROP CONSTRAINT FK_62A8A7A79D86650F');
        $this->addSql('ALTER TABLE stock DROP CONSTRAINT FK_4B365660A848132E');
        $this->addSql('ALTER TABLE stock DROP CONSTRAINT FK_4B365660FC118AC2');
        $this->addSql('DROP TABLE household');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_history');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE "user"');
    }
}
