<?php

namespace App\Database\Migrations;

use Framework\ORM\Migration;

class PostsTable
{         
    /**
     * name of table
     *
     * @var string
     */
    protected static $table = 'posts';

    /**
     * create table
     *
     * @return void
     */
    public static function migrate(): void
    {
        Migration::table(self::$table)
            ->addPrimaryKey()
            ->addString('title')
            ->addString('slug')
            ->addInt('user_id')
            ->addString('image')
            ->addText('content')
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
