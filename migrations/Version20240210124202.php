<?php

declare (strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240210124202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    /** -------------------------------------------------------------
     * Modulacao feita de forma simples e de facil instalacao
     *  -------------------------------------------------------------
     * O sistema trata-se de apenas uma plataforma simples de gerenciamento
     * de finanças, caso queira adicionar um campo novo, basta inserir o campo
     * juntamente com o seu tipo, ir até o diretorio src/entity/NOMEDAENTIDADE
     * e criar o atributo+set+get do mesmo.
     * ---------------------------------------------------------------
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applications (
        id INT AUTO_INCREMENT NOT NULL,
        apport_id INT NOT NULL,
        budget VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NOT NULL,
        update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        ');

        $this->addSql('CREATE TABLE apport (
        id INT AUTO_INCREMENT NOT NULL,
        user_id INT NOT NULL,
        value DECIMAL NOT NULL,
        data_aport VARCHAR(50) NOT NULL,
        created_at TIMESTAMP NOT NULL,
        update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status ENUM("Inativo", "Ativo", "Suspenso") NOT NULL DEFAULT "Inativo",
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        ');

        $this->addSql('CREATE TABLE category (
        id INT AUTO_INCREMENT NOT NULL,
        title VARCHAR(255) NOT NULL,
        subtitle VARCHAR(255) NOT NULL,
        parent VARCHAR(255) DEFAULT NULL,
        status ENUM("Inativo", "Ativo", "Rascunho") NOT NULL DEFAULT "Rascunho",
        created_at TIMESTAMP NOT NULL,
        update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        ');

        $this->addSql('CREATE TABLE banners (
        id INT AUTO_INCREMENT NOT NULL,
        title VARCHAR(255) NOT NULL,
        subtitle VARCHAR(255) NOT NULL,
        cover VARCHAR(255) NOT NULL,
        status ENUM("Inativo", "Ativo", "Rascunho") NOT NULL DEFAULT "Rascunho",
        created_at TIMESTAMP NOT NULL,
        update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        ');

        $this->addSql('CREATE TABLE marketing (
        id INT AUTO_INCREMENT NOT NULL,
        title VARCHAR(255) NOT NULL,
        subtitle VARCHAR(255) NOT NULL,
        count_view VARCHAR(255) DEFAULT NULL,
        users_created VARCHAR(255) DEFAULT NULL,
        status ENUM("Inativo", "Ativo", "Rascunho") NOT NULL DEFAULT "Rascunho",
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');

        $this->addSql('CREATE TABLE marketing_users (
        id INT AUTO_INCREMENT NOT NULL,
        no VARCHAR(50) NOT NULL,
        email VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NOT NULL,
        update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        marketing_id VARCHAR(255) NOT NULL,
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');

        $this->addSql('CREATE TABLE pages (
        id INT AUTO_INCREMENT NOT NULL,
        title VARCHAR(255) NOT NULL,
        subtitle VARCHAR(255) NOT NULL,
        content LONGTEXT NOT NULL,
        status ENUM("Inativo", "Ativo", "Rascunho") NOT NULL DEFAULT "Rascunho",
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');

        $this->addSql('CREATE TABLE users (
        id INT AUTO_INCREMENT NOT NULL,
        name VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        recover VARCHAR(255) DEFAULT NULL,
        access_level VARCHAR(50) NOT NULL DEFAULT '0',
        status ENUM("Inativo", "Ativo", "Suspenso") NOT NULL DEFAULT "Inativo",
        created_at VARCHAR(255) NOT NULL,
        updated_at VARCHAR(255) NOT NULL,
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');

        $this->addSql('CREATE TABLE messenger_messages (
        id BIGINT AUTO_INCREMENT NOT NULL,
        body LONGTEXT NOT NULL,
        headers LONGTEXT NOT NULL,
        queue_name VARCHAR(190) NOT NULL,
        created_at DATETIME NOT NULL,
        available_at DATETIME NOT NULL,
        delivered_at DATETIME DEFAULT NULL,
        INDEX IDX_75EA56E0FB7336F0 (queue_name),
        INDEX IDX_75EA56E0E3BD61CE (available_at),
        INDEX IDX_75EA56E016BA31DB (delivered_at),
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated; please modify it to your needs
        $this->addSql('DROP TABLE applications');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE banners');
        $this->addSql('DROP TABLE marketing');
        $this->addSql('DROP TABLE marketing_users');
        $this->addSql('DROP TABLE pages');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
