<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180730065944 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE figure_picture DROP FOREIGN KEY FK_1C84F60B85F5AD92');
        $this->addSql('ALTER TABLE figure_video DROP FOREIGN KEY FK_6EEA5C1585F5AD92');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37AB3BB53C');
        $this->addSql('CREATE TABLE trick_picture (id INT AUTO_INCREMENT NOT NULL, id_figure_id INT NOT NULL, link LONGTEXT NOT NULL, INDEX IDX_758636D185F5AD92 (id_figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trick (id INT AUTO_INCREMENT NOT NULL, groupid_id INT NOT NULL, authorid_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, published_at DATETIME NOT NULL, updated_date DATETIME NOT NULL, INDEX IDX_D8F0A91EB3BB53C (groupid_id), INDEX IDX_D8F0A91EC68E6693 (authorid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trick_video (id INT AUTO_INCREMENT NOT NULL, id_figure_id INT NOT NULL, id_platform INT NOT NULL, id_video VARCHAR(50) NOT NULL, INDEX IDX_B7E8DA9385F5AD92 (id_figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trick_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trick_picture ADD CONSTRAINT FK_758636D185F5AD92 FOREIGN KEY (id_figure_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EB3BB53C FOREIGN KEY (groupid_id) REFERENCES trick_group (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EC68E6693 FOREIGN KEY (authorid_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE trick_video ADD CONSTRAINT FK_B7E8DA9385F5AD92 FOREIGN KEY (id_figure_id) REFERENCES trick (id)');
        $this->addSql('DROP TABLE figure_video');
		$this->addSql('DROP TABLE figure_group');
        $this->addSql('DROP TABLE figure_picture');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB80E8715');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB80E8715 FOREIGN KEY (figureid_id) REFERENCES trick (id)');
		$this->addSql('DROP TABLE figure');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trick_picture DROP FOREIGN KEY FK_758636D185F5AD92');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB80E8715');
        $this->addSql('ALTER TABLE trick_video DROP FOREIGN KEY FK_B7E8DA9385F5AD92');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EB3BB53C');
        $this->addSql('CREATE TABLE figure (id INT AUTO_INCREMENT NOT NULL, groupid_id INT NOT NULL, authorid_id INT NOT NULL, name VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, published_at DATETIME NOT NULL, updated_date DATETIME NOT NULL, INDEX IDX_2F57B37AB3BB53C (groupid_id), INDEX IDX_2F57B37AC68E6693 (authorid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure_picture (id INT AUTO_INCREMENT NOT NULL, id_figure_id INT NOT NULL, link LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_1C84F60B85F5AD92 (id_figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure_video (id INT AUTO_INCREMENT NOT NULL, id_figure_id INT NOT NULL, id_platform INT NOT NULL, id_video VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_6EEA5C1585F5AD92 (id_figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AB3BB53C FOREIGN KEY (groupid_id) REFERENCES figure_group (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AC68E6693 FOREIGN KEY (authorid_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE figure_picture ADD CONSTRAINT FK_1C84F60B85F5AD92 FOREIGN KEY (id_figure_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE figure_video ADD CONSTRAINT FK_6EEA5C1585F5AD92 FOREIGN KEY (id_figure_id) REFERENCES figure (id)');
        $this->addSql('DROP TABLE trick_picture');
        $this->addSql('DROP TABLE trick');
        $this->addSql('DROP TABLE trick_video');
        $this->addSql('DROP TABLE trick_group');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB80E8715');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB80E8715 FOREIGN KEY (figureid_id) REFERENCES figure (id)');
    }
}
