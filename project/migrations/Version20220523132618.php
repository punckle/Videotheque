<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523132618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tv_show (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, original_title VARCHAR(255) DEFAULT NULL, poster_path VARCHAR(255) DEFAULT NULL, popularity DOUBLE PRECISION DEFAULT NULL, movie_db_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_show_type (tv_show_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_B431ACD55E3A35BB (tv_show_id), INDEX IDX_B431ACD5C54C8C93 (type_id), PRIMARY KEY(tv_show_id, type_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tv_show_type ADD CONSTRAINT FK_B431ACD55E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_show_type ADD CONSTRAINT FK_B431ACD5C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tv_show_type DROP FOREIGN KEY FK_B431ACD55E3A35BB');
        $this->addSql('DROP TABLE tv_show');
        $this->addSql('DROP TABLE tv_show_type');
    }
}
