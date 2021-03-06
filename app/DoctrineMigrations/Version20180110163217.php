<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180110163217 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fos_user_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_583D1F3E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user_user (id INT AUTO_INCREMENT NOT NULL, grupo_local_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) DEFAULT NULL, website VARCHAR(64) DEFAULT NULL, biography VARCHAR(255) DEFAULT NULL, gender VARCHAR(1) DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, facebook_uid VARCHAR(255) DEFAULT NULL, facebook_name VARCHAR(255) DEFAULT NULL, facebook_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', twitter_uid VARCHAR(255) DEFAULT NULL, twitter_name VARCHAR(255) DEFAULT NULL, twitter_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', gplus_uid VARCHAR(255) DEFAULT NULL, gplus_name VARCHAR(255) DEFAULT NULL, gplus_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', token VARCHAR(255) DEFAULT NULL, two_step_code VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C560D76192FC23A8 (username_canonical), UNIQUE INDEX UNIQ_C560D761A0D96FBF (email_canonical), INDEX IDX_C560D76115B71EC4 (grupo_local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B3C77447A76ED395 (user_id), INDEX IDX_B3C77447FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aliases (pkid SMALLINT AUTO_INCREMENT NOT NULL, mail VARCHAR(120) NOT NULL, destination VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_5F12BB395126AC48 (mail), PRIMARY KEY(pkid)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domains (pkid SMALLINT AUTO_INCREMENT NOT NULL, domain VARCHAR(120) NOT NULL, transport VARCHAR(120) NOT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(pkid)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id VARCHAR(128) NOT NULL, name VARCHAR(128) NOT NULL, uid SMALLINT NOT NULL, gid SMALLINT NOT NULL, home VARCHAR(255) NOT NULL, maildir VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, change_password TINYINT(1) NOT NULL, clear VARCHAR(128) NOT NULL, crypt VARCHAR(128) NOT NULL, quota VARCHAR(255) NOT NULL, procmailrc VARCHAR(128) NOT NULL, spamassassinrc VARCHAR(128) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE somenergia_codigo_postal (id INT AUTO_INCREMENT NOT NULL, cp VARCHAR(32) NOT NULL, poblacion VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_23555EA25F0C5BA7 (cp), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE somenergia_asamblea_asamblea (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE somenergia_asamblea_asistencia (id INT AUTO_INCREMENT NOT NULL, socio_id INT DEFAULT NULL, asamblea_id INT DEFAULT NULL, sede_id INT DEFAULT NULL, INDEX IDX_D44116F6DA04E6A9 (socio_id), INDEX IDX_D44116F6CF020096 (asamblea_id), INDEX IDX_D44116F6E19F41BF (sede_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE somenergia_asamblea_sede (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8A4813023A909126 (nombre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Socio (id INT AUTO_INCREMENT NOT NULL, erpid INT NOT NULL, active TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, ref VARCHAR(64) DEFAULT NULL, vat VARCHAR(32) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, street VARCHAR(128) DEFAULT NULL, city VARCHAR(128) DEFAULT NULL, zip VARCHAR(24) DEFAULT NULL, mobile VARCHAR(64) DEFAULT NULL, email VARCHAR(240) DEFAULT NULL, language VARCHAR(32) DEFAULT NULL, fechaAlta DATE DEFAULT NULL, fechaBaja DATE DEFAULT NULL, UNIQUE INDEX UNIQ_F9777C0DFCD77AC8 (erpid), UNIQUE INDEX UNIQ_F9777C0D146F3EA3 (ref), INDEX erpid_idx (erpid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE somenergia_grupo_local (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8EA8D20C3A909126 (nombre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE somenergia_grupo_local_codigo_postal (grupolocal_id INT NOT NULL, codigopostal_id INT NOT NULL, INDEX IDX_DA84F128761B4EDB (grupolocal_id), INDEX IDX_DA84F1288492D372 (codigopostal_id), PRIMARY KEY(grupolocal_id, codigopostal_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_classes (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_type VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_69DD750638A36066 (class_type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_security_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, identifier VARCHAR(200) NOT NULL, username TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8835EE78772E836AF85E0677 (identifier, username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_object_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent_object_identity_id INT UNSIGNED DEFAULT NULL, class_id INT UNSIGNED NOT NULL, object_identifier VARCHAR(100) NOT NULL, entries_inheriting TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 (object_identifier, class_id), INDEX IDX_9407E54977FA751A (parent_object_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_object_identity_ancestors (object_identity_id INT UNSIGNED NOT NULL, ancestor_id INT UNSIGNED NOT NULL, INDEX IDX_825DE2993D9AB4A6 (object_identity_id), INDEX IDX_825DE299C671CEA1 (ancestor_id), PRIMARY KEY(object_identity_id, ancestor_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_entries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_id INT UNSIGNED NOT NULL, object_identity_id INT UNSIGNED DEFAULT NULL, security_identity_id INT UNSIGNED NOT NULL, field_name VARCHAR(50) DEFAULT NULL, ace_order SMALLINT UNSIGNED NOT NULL, mask INT NOT NULL, granting TINYINT(1) NOT NULL, granting_strategy VARCHAR(30) NOT NULL, audit_success TINYINT(1) NOT NULL, audit_failure TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 (class_id, object_identity_id, field_name, ace_order), INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 (class_id, object_identity_id, security_identity_id), INDEX IDX_46C8B806EA000B10 (class_id), INDEX IDX_46C8B8063D9AB4A6 (object_identity_id), INDEX IDX_46C8B806DF9183C9 (security_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fos_user_user ADD CONSTRAINT FK_C560D76115B71EC4 FOREIGN KEY (grupo_local_id) REFERENCES somenergia_grupo_local (id)');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_user_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia ADD CONSTRAINT FK_D44116F6DA04E6A9 FOREIGN KEY (socio_id) REFERENCES Socio (id)');
        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia ADD CONSTRAINT FK_D44116F6CF020096 FOREIGN KEY (asamblea_id) REFERENCES somenergia_asamblea_asamblea (id)');
        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia ADD CONSTRAINT FK_D44116F6E19F41BF FOREIGN KEY (sede_id) REFERENCES somenergia_asamblea_sede (id)');
        $this->addSql('ALTER TABLE somenergia_grupo_local_codigo_postal ADD CONSTRAINT FK_DA84F128761B4EDB FOREIGN KEY (grupolocal_id) REFERENCES somenergia_grupo_local (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE somenergia_grupo_local_codigo_postal ADD CONSTRAINT FK_DA84F1288492D372 FOREIGN KEY (codigopostal_id) REFERENCES somenergia_codigo_postal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_object_identities ADD CONSTRAINT FK_9407E54977FA751A FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities (id)');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806EA000B10 FOREIGN KEY (class_id) REFERENCES acl_classes (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B8063D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447FE54D947');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447A76ED395');
        $this->addSql('ALTER TABLE somenergia_grupo_local_codigo_postal DROP FOREIGN KEY FK_DA84F1288492D372');
        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia DROP FOREIGN KEY FK_D44116F6CF020096');
        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia DROP FOREIGN KEY FK_D44116F6E19F41BF');
        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia DROP FOREIGN KEY FK_D44116F6DA04E6A9');
        $this->addSql('ALTER TABLE fos_user_user DROP FOREIGN KEY FK_C560D76115B71EC4');
        $this->addSql('ALTER TABLE somenergia_grupo_local_codigo_postal DROP FOREIGN KEY FK_DA84F128761B4EDB');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806EA000B10');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806DF9183C9');
        $this->addSql('ALTER TABLE acl_object_identities DROP FOREIGN KEY FK_9407E54977FA751A');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE2993D9AB4A6');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE299C671CEA1');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B8063D9AB4A6');
        $this->addSql('DROP TABLE fos_user_group');
        $this->addSql('DROP TABLE fos_user_user');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('DROP TABLE aliases');
        $this->addSql('DROP TABLE domains');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE somenergia_codigo_postal');
        $this->addSql('DROP TABLE somenergia_asamblea_asamblea');
        $this->addSql('DROP TABLE somenergia_asamblea_asistencia');
        $this->addSql('DROP TABLE somenergia_asamblea_sede');
        $this->addSql('DROP TABLE Socio');
        $this->addSql('DROP TABLE somenergia_grupo_local');
        $this->addSql('DROP TABLE somenergia_grupo_local_codigo_postal');
        $this->addSql('DROP TABLE acl_classes');
        $this->addSql('DROP TABLE acl_security_identities');
        $this->addSql('DROP TABLE acl_object_identities');
        $this->addSql('DROP TABLE acl_object_identity_ancestors');
        $this->addSql('DROP TABLE acl_entries');
    }
}
