<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180110165233 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia DROP FOREIGN KEY FK_D44116F6CF020096');
        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia DROP FOREIGN KEY FK_D44116F6E19F41BF');
        $this->addSql('DROP TABLE somenergia_asamblea_asamblea');
        $this->addSql('DROP TABLE somenergia_asamblea_asistencia');
        $this->addSql('DROP TABLE somenergia_asamblea_sede');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE somenergia_asamblea_asamblea (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, fecha DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE somenergia_asamblea_asistencia (id INT AUTO_INCREMENT NOT NULL, socio_id INT DEFAULT NULL, asamblea_id INT DEFAULT NULL, sede_id INT DEFAULT NULL, INDEX IDX_D44116F6DA04E6A9 (socio_id), INDEX IDX_D44116F6CF020096 (asamblea_id), INDEX IDX_D44116F6E19F41BF (sede_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE somenergia_asamblea_sede (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_8A4813023A909126 (nombre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia ADD CONSTRAINT FK_D44116F6CF020096 FOREIGN KEY (asamblea_id) REFERENCES somenergia_asamblea_asamblea (id)');
        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia ADD CONSTRAINT FK_D44116F6DA04E6A9 FOREIGN KEY (socio_id) REFERENCES Socio (id)');
        $this->addSql('ALTER TABLE somenergia_asamblea_asistencia ADD CONSTRAINT FK_D44116F6E19F41BF FOREIGN KEY (sede_id) REFERENCES somenergia_asamblea_sede (id)');
    }
}
