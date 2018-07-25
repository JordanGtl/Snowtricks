<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180723085317 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE member CHANGE password password VARCHAR(64) NOT NULL, CHANGE rank rank LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE login username VARCHAR(50) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E4FA78F85E0677 ON member (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E4FA78E7927C74 ON member (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_70E4FA78F85E0677 ON member');
        $this->addSql('DROP INDEX UNIQ_70E4FA78E7927C74 ON member');
        $this->addSql('ALTER TABLE member CHANGE password password VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE rank rank INT NOT NULL, CHANGE username login VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
