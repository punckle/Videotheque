<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523133729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tv_show_actor (tv_show_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_F04607355E3A35BB (tv_show_id), INDEX IDX_F046073510DAF24A (actor_id), PRIMARY KEY(tv_show_id, actor_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tv_show_actor ADD CONSTRAINT FK_F04607355E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_show_actor ADD CONSTRAINT FK_F046073510DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_show ADD year VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tv_show_actor');
        $this->addSql('ALTER TABLE tv_show DROP year');
    }
}
