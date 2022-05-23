<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523151235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tv_show_user (id INT AUTO_INCREMENT NOT NULL, tv_show_id INT DEFAULT NULL, user_id INT DEFAULT NULL, rate DOUBLE PRECISION DEFAULT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_B57C2DB55E3A35BB (tv_show_id), INDEX IDX_B57C2DB5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tv_show_user ADD CONSTRAINT FK_B57C2DB55E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id)');
        $this->addSql('ALTER TABLE tv_show_user ADD CONSTRAINT FK_B57C2DB5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tv_show_user');
    }
}
