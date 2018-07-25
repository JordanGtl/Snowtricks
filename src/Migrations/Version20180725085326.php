<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180725085326 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE figure_picture (id INT AUTO_INCREMENT NOT NULL, id_figure_id INT NOT NULL, link LONGTEXT NOT NULL, INDEX IDX_1C84F60B85F5AD92 (id_figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure_video (id INT AUTO_INCREMENT NOT NULL, id_figure_id INT NOT NULL, id_platform INT NOT NULL, id_video VARCHAR(50) NOT NULL, INDEX IDX_6EEA5C1585F5AD92 (id_figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE figure_picture ADD CONSTRAINT FK_1C84F60B85F5AD92 FOREIGN KEY (id_figure_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE figure_video ADD CONSTRAINT FK_6EEA5C1585F5AD92 FOREIGN KEY (id_figure_id) REFERENCES figure (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE figure_picture');
        $this->addSql('DROP TABLE figure_video');
    }
}
