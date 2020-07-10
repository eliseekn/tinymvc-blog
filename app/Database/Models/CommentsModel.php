<?php

namespace App\Database\Models;

use Framework\ORM\Model;
use Framework\ORM\Query;

class CommentsModel extends Model
{    
    /**
     * name of table
     *
     * @var string
     */
    protected static $table = 'comments';
    
    /**
     * findComments
     *
     * @return mixed
     */
    public static function findComments()
    {
        return Query::DB()
            ->select(
                'comments.*',
                'posts.title AS post_title'
            )
            ->from(static::$table)
            ->innerJoin('posts', 'comments.post_id', 'posts.id')
            ->orderBy('comments.id', 'DESC')
            ->fetchAll();
    }
}