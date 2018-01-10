<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180110164417 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE aliases');
        $this->addSql('DROP TABLE domains');
        $this->addSql('DROP TABLE users');
        $this->addSql('CREATE INDEX erpid_idx ON Socio (erpid)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aliases (pkid SMALLINT AUTO_INCREMENT NOT NULL, mail VARCHAR(120) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, destination VARCHAR(255) NOT NULL COLLATE utf8_general_ci, enabled TINYINT(1) NOT NULL, UNIQUE INDEX mail (mail), PRIMARY KEY(pkid)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domains (pkid SMALLINT AUTO_INCREMENT NOT NULL, domain VARCHAR(120) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, transport VARCHAR(120) NOT NULL COLLATE utf8_general_ci, enabled TINYINT(1) NOT NULL, PRIMARY KEY(pkid)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id VARCHAR(128) NOT NULL COLLATE utf8_general_ci, name VARCHAR(128) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, uid SMALLINT NOT NULL, gid SMALLINT NOT NULL, home VARCHAR(255) NOT NULL COLLATE utf8_general_ci, maildir VARCHAR(255) NOT NULL COLLATE utf8_general_ci, enabled TINYINT(1) NOT NULL, change_password TINYINT(1) NOT NULL, clear VARCHAR(128) NOT NULL COLLATE utf8_general_ci, crypt VARCHAR(128) NOT NULL COLLATE utf8_general_ci, quota VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, procmailrc VARCHAR(128) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, spamassassinrc VARCHAR(128) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP INDEX erpid_idx ON Socio');
    }
}
