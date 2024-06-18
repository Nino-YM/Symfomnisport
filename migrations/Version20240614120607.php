<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240614120607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activities_members (activities_id INT NOT NULL, members_id INT NOT NULL, INDEX IDX_4DD2F6D82A4DB562 (activities_id), INDEX IDX_4DD2F6D8BD01F5ED (members_id), PRIMARY KEY(activities_id, members_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activities_teams (activities_id INT NOT NULL, teams_id INT NOT NULL, INDEX IDX_554B018B2A4DB562 (activities_id), INDEX IDX_554B018BD6365F12 (teams_id), PRIMARY KEY(activities_id, teams_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE members_teams (members_id INT NOT NULL, teams_id INT NOT NULL, INDEX IDX_30311F1FBD01F5ED (members_id), INDEX IDX_30311F1FD6365F12 (teams_id), PRIMARY KEY(members_id, teams_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activities_members ADD CONSTRAINT FK_4DD2F6D82A4DB562 FOREIGN KEY (activities_id) REFERENCES activities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activities_members ADD CONSTRAINT FK_4DD2F6D8BD01F5ED FOREIGN KEY (members_id) REFERENCES members (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activities_teams ADD CONSTRAINT FK_554B018B2A4DB562 FOREIGN KEY (activities_id) REFERENCES activities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activities_teams ADD CONSTRAINT FK_554B018BD6365F12 FOREIGN KEY (teams_id) REFERENCES teams (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE members_teams ADD CONSTRAINT FK_30311F1FBD01F5ED FOREIGN KEY (members_id) REFERENCES members (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE members_teams ADD CONSTRAINT FK_30311F1FD6365F12 FOREIGN KEY (teams_id) REFERENCES teams (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activities ADD section_id INT NOT NULL');
        $this->addSql('ALTER TABLE activities ADD CONSTRAINT FK_B5F1AFE5D823E37A FOREIGN KEY (section_id) REFERENCES sections (id)');
        $this->addSql('CREATE INDEX IDX_B5F1AFE5D823E37A ON activities (section_id)');
        $this->addSql('ALTER TABLE members ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE members ADD CONSTRAINT FK_45A0D2FFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45A0D2FFA76ED395 ON members (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activities_members DROP FOREIGN KEY FK_4DD2F6D82A4DB562');
        $this->addSql('ALTER TABLE activities_members DROP FOREIGN KEY FK_4DD2F6D8BD01F5ED');
        $this->addSql('ALTER TABLE activities_teams DROP FOREIGN KEY FK_554B018B2A4DB562');
        $this->addSql('ALTER TABLE activities_teams DROP FOREIGN KEY FK_554B018BD6365F12');
        $this->addSql('ALTER TABLE members_teams DROP FOREIGN KEY FK_30311F1FBD01F5ED');
        $this->addSql('ALTER TABLE members_teams DROP FOREIGN KEY FK_30311F1FD6365F12');
        $this->addSql('DROP TABLE activities_members');
        $this->addSql('DROP TABLE activities_teams');
        $this->addSql('DROP TABLE members_teams');
        $this->addSql('ALTER TABLE activities DROP FOREIGN KEY FK_B5F1AFE5D823E37A');
        $this->addSql('DROP INDEX IDX_B5F1AFE5D823E37A ON activities');
        $this->addSql('ALTER TABLE activities DROP section_id');
        $this->addSql('ALTER TABLE members DROP FOREIGN KEY FK_45A0D2FFA76ED395');
        $this->addSql('DROP INDEX UNIQ_45A0D2FFA76ED395 ON members');
        $this->addSql('ALTER TABLE members DROP user_id');
    }
}
