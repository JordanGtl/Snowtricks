<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180730081103 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB80E8715');
        $this->addSql('DROP INDEX IDX_9474526CB80E8715 ON comment');
        $this->addSql('ALTER TABLE comment CHANGE figureid_id trickid_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6CD2DDFC FOREIGN KEY (trickid_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_9474526C6CD2DDFC ON comment (trickid_id)');
        $this->addSql('ALTER TABLE trick CHANGE groupid_id groupid_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6CD2DDFC');
        $this->addSql('DROP INDEX IDX_9474526C6CD2DDFC ON comment');
        $this->addSql('ALTER TABLE comment CHANGE trickid_id figureid_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB80E8715 FOREIGN KEY (figureid_id) REFERENCES trick (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_9474526CB80E8715 ON comment (figureid_id)');
        $this->addSql('ALTER TABLE trick CHANGE groupid_id groupid_id INT NOT NULL');
    }
}
