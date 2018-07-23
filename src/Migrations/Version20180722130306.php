<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180722130306 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, figureid_id INT NOT NULL, authorid_id INT NOT NULL, updatedate DATETIME NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_9474526CB80E8715 (figureid_id), INDEX IDX_9474526CC68E6693 (authorid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(50) NOT NULL, password VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, validationtoken VARCHAR(100) NOT NULL, passwordtoken VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure (id INT AUTO_INCREMENT NOT NULL, groupid_id INT NOT NULL, authorid_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_2F57B37AB3BB53C (groupid_id), INDEX IDX_2F57B37AC68E6693 (authorid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `figure_group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB80E8715 FOREIGN KEY (figureid_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CC68E6693 FOREIGN KEY (authorid_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AB3BB53C FOREIGN KEY (groupid_id) REFERENCES `figure_group` (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AC68E6693 FOREIGN KEY (authorid_id) REFERENCES member (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CC68E6693');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37AC68E6693');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB80E8715');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37AB3BB53C');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE figure');
        $this->addSql('DROP TABLE `figure_group`');
    }
}
