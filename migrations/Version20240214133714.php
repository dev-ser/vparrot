<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214133714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD user_id INT DEFAULT NULL, ADD employes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0F971F91F FOREIGN KEY (employes_id) REFERENCES employes (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0A76ED395 ON avis (user_id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0F971F91F ON avis (employes_id)');
        $this->addSql('ALTER TABLE contact ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638A76ED395 ON contact (user_id)');
        $this->addSql('ALTER TABLE horaires ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE horaires ADD CONSTRAINT FK_39B7118FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_39B7118FA76ED395 ON horaires (user_id)');
        $this->addSql('ALTER TABLE voitures ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voitures ADD CONSTRAINT FK_8B58301BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_8B58301BA76ED395 ON voitures (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0F971F91F');
        $this->addSql('DROP INDEX IDX_8F91ABF0A76ED395 ON avis');
        $this->addSql('DROP INDEX IDX_8F91ABF0F971F91F ON avis');
        $this->addSql('ALTER TABLE avis DROP user_id, DROP employes_id');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A76ED395');
        $this->addSql('DROP INDEX IDX_4C62E638A76ED395 ON contact');
        $this->addSql('ALTER TABLE contact DROP user_id');
        $this->addSql('ALTER TABLE voitures DROP FOREIGN KEY FK_8B58301BA76ED395');
        $this->addSql('DROP INDEX IDX_8B58301BA76ED395 ON voitures');
        $this->addSql('ALTER TABLE voitures DROP user_id');
        $this->addSql('ALTER TABLE horaires DROP FOREIGN KEY FK_39B7118FA76ED395');
        $this->addSql('DROP INDEX IDX_39B7118FA76ED395 ON horaires');
        $this->addSql('ALTER TABLE horaires DROP user_id');
    }
}
