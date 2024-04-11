<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231203204810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE roles_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE roles (id INT NOT NULL, name VARCHAR(60) NOT NULL, description VARCHAR(255) NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, uuid UUID NOT NULL, login VARCHAR(50) NOT NULL, password VARCHAR(60) DEFAULT NULL, status_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9D17F50A6 ON users (uuid)');
        $this->addSql('CREATE INDEX idx_login ON users (login)');
        $this->addSql('CREATE INDEX idx_status_id ON users (status_id)');
        $this->addSql('COMMENT ON COLUMN users.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE roles_to_users (user_doctrine_entity_id INT NOT NULL, role_doctrine_entity_id INT NOT NULL, PRIMARY KEY(user_doctrine_entity_id, role_doctrine_entity_id))');
        $this->addSql('CREATE INDEX IDX_35EAE13B43464285 ON roles_to_users (user_doctrine_entity_id)');
        $this->addSql('CREATE INDEX IDX_35EAE13BC240A234 ON roles_to_users (role_doctrine_entity_id)');
        $this->addSql('CREATE TABLE users_data (id INT NOT NULL, user_id INT NOT NULL, content JSONB NOT NULL, status_id INT DEFAULT 1 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX fk_users ON users_data (user_id)');
        $this->addSql('CREATE INDEX idx_content ON users_data (content)');
        $this->addSql('ALTER TABLE roles_to_users ADD CONSTRAINT FK_35EAE13B43464285 FOREIGN KEY (user_doctrine_entity_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roles_to_users ADD CONSTRAINT FK_35EAE13BC240A234 FOREIGN KEY (role_doctrine_entity_id) REFERENCES roles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_data ADD CONSTRAINT FK_627ABD6DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE roles_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_data_id_seq CASCADE');
        $this->addSql('ALTER TABLE roles_to_users DROP CONSTRAINT FK_35EAE13B43464285');
        $this->addSql('ALTER TABLE roles_to_users DROP CONSTRAINT FK_35EAE13BC240A234');
        $this->addSql('ALTER TABLE users_data DROP CONSTRAINT FK_627ABD6DA76ED395');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE roles_to_users');
        $this->addSql('DROP TABLE users_data');
    }
}
