<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190602123204 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE grupo (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(64) NOT NULL, tipo TINYINT(1) DEFAULT \'0\' NOT NULL, descripcion LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8C0E9BD317713E5A702D1D47 (titulo, tipo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE productor (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(64) NOT NULL, thumbsrc VARCHAR(255) DEFAULT NULL, descripcion LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_173A07017713E5A (titulo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(64) NOT NULL, descripcion LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_4E10122D17713E5A (titulo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria_video (categoria_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_7DF013EF3397707A (categoria_id), INDEX IDX_7DF013EF29C1004E (video_id), PRIMARY KEY(categoria_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, director_id INT DEFAULT NULL, productor_id INT DEFAULT NULL, temporada_id INT DEFAULT NULL, grupo_id INT DEFAULT NULL, titulo VARCHAR(64) NOT NULL, tipo TINYINT(1) DEFAULT \'0\' NOT NULL, src VARCHAR(255) NOT NULL, thumbsrc VARCHAR(255) DEFAULT NULL, premium TINYINT(1) DEFAULT NULL, edad SMALLINT DEFAULT NULL, pais VARCHAR(64) DEFAULT NULL, fechaonline DATETIME NOT NULL, fecharodada DATETIME DEFAULT NULL, terminoomdb VARCHAR(255) DEFAULT NULL, descripcion LONGTEXT DEFAULT NULL, INDEX IDX_7CC7DA2C899FB366 (director_id), INDEX IDX_7CC7DA2C55BB310E (productor_id), INDEX IDX_7CC7DA2C6E1CF8A8 (temporada_id), INDEX IDX_7CC7DA2C9C833003 (grupo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE director (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(64) NOT NULL, thumbsrc VARCHAR(255) DEFAULT NULL, descripcion LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_1E90D3F017713E5A (titulo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, type TINYINT(1) DEFAULT \'0\' NOT NULL, apodo VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, nombre VARCHAR(64) NOT NULL, apellidos VARCHAR(64) NOT NULL, correo VARCHAR(255) NOT NULL, activo TINYINT(1) DEFAULT \'0\' NOT NULL, locale VARCHAR(4) DEFAULT NULL, fechaalta DATETIME NOT NULL, fechapremium DATETIME DEFAULT NULL, fechanac DATETIME NOT NULL, videolang VARCHAR(64) DEFAULT NULL, UNIQUE INDEX UNIQ_2265B05D9658570B (apodo), UNIQUE INDEX UNIQ_2265B05D77040BC9 (correo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_video (usuario_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_6119B032DB38439E (usuario_id), INDEX IDX_6119B03229C1004E (video_id), PRIMARY KEY(usuario_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado_video (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, video_id INT NOT NULL, completo TINYINT(1) DEFAULT \'0\' NOT NULL, tiempo INT DEFAULT 0 NOT NULL, tiempototal INT DEFAULT 0 NOT NULL, porcentaje SMALLINT DEFAULT 0 NOT NULL, modificado DATETIME NOT NULL, INDEX IDX_763C5CDEDB38439E (usuario_id), INDEX IDX_763C5CDE29C1004E (video_id), UNIQUE INDEX UNIQ_763C5CDEDB38439E29C1004E (usuario_id, video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temporada (id INT AUTO_INCREMENT NOT NULL, serie_id INT NOT NULL, titulo VARCHAR(64) NOT NULL, orden SMALLINT NOT NULL, descripcion LONGTEXT DEFAULT NULL, INDEX IDX_9A6BDEBDD94388BD (serie_id), UNIQUE INDEX UNIQ_9A6BDEBDE128CFD7D94388BD (orden, serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pago (id INT AUTO_INCREMENT NOT NULL, cuentausuario_id INT NOT NULL, nombretitular VARCHAR(64) NOT NULL, apellidotitular VARCHAR(64) NOT NULL, empresatarjeta VARCHAR(64) DEFAULT NULL, numerotarjeta VARCHAR(20) NOT NULL, cvv VARCHAR(5) NOT NULL, fecha DATETIME NOT NULL, importe VARCHAR(255) NOT NULL, INDEX IDX_F4DF5F3EBB26F936 (cuentausuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categoria_video ADD CONSTRAINT FK_7DF013EF3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categoria_video ADD CONSTRAINT FK_7DF013EF29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C899FB366 FOREIGN KEY (director_id) REFERENCES director (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C55BB310E FOREIGN KEY (productor_id) REFERENCES productor (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C6E1CF8A8 FOREIGN KEY (temporada_id) REFERENCES temporada (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C9C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE usuario_video ADD CONSTRAINT FK_6119B032DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_video ADD CONSTRAINT FK_6119B03229C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE estado_video ADD CONSTRAINT FK_763C5CDEDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE estado_video ADD CONSTRAINT FK_763C5CDE29C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE temporada ADD CONSTRAINT FK_9A6BDEBDD94388BD FOREIGN KEY (serie_id) REFERENCES grupo (id)');
        $this->addSql('ALTER TABLE pago ADD CONSTRAINT FK_F4DF5F3EBB26F936 FOREIGN KEY (cuentausuario_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C9C833003');
        $this->addSql('ALTER TABLE temporada DROP FOREIGN KEY FK_9A6BDEBDD94388BD');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C55BB310E');
        $this->addSql('ALTER TABLE categoria_video DROP FOREIGN KEY FK_7DF013EF3397707A');
        $this->addSql('ALTER TABLE categoria_video DROP FOREIGN KEY FK_7DF013EF29C1004E');
        $this->addSql('ALTER TABLE usuario_video DROP FOREIGN KEY FK_6119B03229C1004E');
        $this->addSql('ALTER TABLE estado_video DROP FOREIGN KEY FK_763C5CDE29C1004E');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C899FB366');
        $this->addSql('ALTER TABLE usuario_video DROP FOREIGN KEY FK_6119B032DB38439E');
        $this->addSql('ALTER TABLE estado_video DROP FOREIGN KEY FK_763C5CDEDB38439E');
        $this->addSql('ALTER TABLE pago DROP FOREIGN KEY FK_F4DF5F3EBB26F936');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C6E1CF8A8');
        $this->addSql('DROP TABLE grupo');
        $this->addSql('DROP TABLE productor');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE categoria_video');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE director');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE usuario_video');
        $this->addSql('DROP TABLE estado_video');
        $this->addSql('DROP TABLE temporada');
        $this->addSql('DROP TABLE pago');
    }
}
