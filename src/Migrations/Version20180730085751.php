<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180730085751 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE trick_media (id INT AUTO_INCREMENT NOT NULL, id_trick_id INT NOT NULL, link LONGTEXT NOT NULL, type INT NOT NULL, INDEX IDX_A103A1B3E25A52BB (id_trick_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trick_media ADD CONSTRAINT FK_A103A1B3E25A52BB FOREIGN KEY (id_trick_id) REFERENCES trick (id)');
        $this->addSql('DROP TABLE trick_picture');
        $this->addSql('DROP TABLE trick_video');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6CD2DDFC');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6CD2DDFC FOREIGN KEY (trickid_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE trick CHANGE groupid_id groupid_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE trick_picture (id INT AUTO_INCREMENT NOT NULL, id_figure_id INT NOT NULL, link LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_758636D185F5AD92 (id_figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trick_video (id INT AUTO_INCREMENT NOT NULL, id_figure_id INT NOT NULL, id_platform INT NOT NULL, id_video VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_B7E8DA9385F5AD92 (id_figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trick_picture ADD CONSTRAINT FK_758636D185F5AD92 FOREIGN KEY (id_figure_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE trick_video ADD CONSTRAINT FK_B7E8DA9385F5AD92 FOREIGN KEY (id_figure_id) REFERENCES trick (id)');
        $this->addSql('DROP TABLE trick_media');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6CD2DDFC');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6CD2DDFC FOREIGN KEY (trickid_id) REFERENCES trick (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trick CHANGE groupid_id groupid_id INT NOT NULL');
    }
}
