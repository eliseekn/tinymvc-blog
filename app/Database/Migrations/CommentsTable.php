<?php

namespace App\Database\Migrations;

use Framework\ORM\Migration;

class CommentsTable
{         
    /**
     * name of table
     *
     * @var string
     */
    protected static $table = 'comments';

    /**
     * create table
     *
     * @return void
     */
    public static function migrate(): void
    {
        Migration::table(self::$table)
            ->addPrimaryKey()
            ->addInt('post_id')
            ->addString('email')
            ->addText('comment')
            ->addTimestamp('created_at')
            ->addTimestamp('updated_at')
            ->create();
    }
    
    /**
     * drop table
     *
     * @return void
     */
    public static function delete(): void
    {
        Migration::dropTable(self::$table);
    }
    
    /**
     * roll back actions
     *
     * @return void
     */
    public static function rollBack(): void
    {
        self::delete();
        self::migrate();
    }
}
