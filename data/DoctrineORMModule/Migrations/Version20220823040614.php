<?php

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20220823040614 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("
        create table public.post
        (
            id          uuid         not null primary key ,
            title       varchar(100) not null,
            description varchar(5000) not null
        )");
    }

    public function down(Schema $schema)
    {
        // TODO: Implement down() method.
    }
}