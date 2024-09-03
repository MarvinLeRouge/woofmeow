<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240902192327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, species VARCHAR(255) NOT NULL, breed VARCHAR(255) DEFAULT NULL, sex VARCHAR(255) NOT NULL, sterilized BOOLEAN NOT NULL, tattoo VARCHAR(255) DEFAULT NULL, chip_number VARCHAR(255) DEFAULT NULL, birth_date DATE NOT NULL, death_date DATE DEFAULT NULL, next_visit_date DATE DEFAULT NULL, CONSTRAINT FK_6AAB231F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6AAB231F7E3C61F9 ON animal (owner_id)');
        $this->addSql('CREATE TABLE prescription (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, visit_id INTEGER DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, CONSTRAINT FK_1FBFB8D975FA0FF2 FOREIGN KEY (visit_id) REFERENCES visit (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_1FBFB8D975FA0FF2 ON prescription (visit_id)');
        $this->addSql('CREATE TABLE prescription_line (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prescription_id INTEGER NOT NULL, drug_name VARCHAR(255) NOT NULL, batch_number VARCHAR(255) DEFAULT NULL, dosage INTEGER NOT NULL, unit VARCHAR(255) NOT NULL, frequency VARCHAR(255) NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, CONSTRAINT FK_D34A080393DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D34A080393DB413D ON prescription_line (prescription_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
        $this->addSql('CREATE TABLE vaccine (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, visit_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, batch_number VARCHAR(255) NOT NULL, report CLOB DEFAULT NULL, next_shot_date DATE DEFAULT NULL, CONSTRAINT FK_A7DD90B175FA0FF2 FOREIGN KEY (visit_id) REFERENCES visit (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A7DD90B175FA0FF2 ON vaccine (visit_id)');
        $this->addSql('CREATE TABLE visit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, animal_id INTEGER NOT NULL, visit_date DATE NOT NULL, title VARCHAR(255) NOT NULL, report CLOB DEFAULT NULL, CONSTRAINT FK_437EE9398E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_437EE9398E962C16 ON visit (animal_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE prescription_line');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vaccine');
        $this->addSql('DROP TABLE visit');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
