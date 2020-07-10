<?php

namespace App\Database\Models;

use Framework\ORM\Model;
use Framework\ORM\Query;
use Framework\HTTP\Request;
use Framework\Support\Pager;

class PostsModel extends Model
{    
    /**
     * name of table
     *
     * @var string
     */
    protected static $table = 'posts';
    
    /**
     * findPosts
     *
     * @return mixed
     */
    public static function findPosts()
    {
        return Query::DB()
            ->select(
                'posts.*',
                'users.name AS author_name'
            )
            ->from(static::$table)
            ->innerJoin('users', 'posts.user_id', 'users.id')
            ->orderBy('posts.id', 'DESC')
            ->fetchAll();
    }
    
    /**
     * paginatePosts
     *
     * @param  int $items_per_pages
     * @return mixed new pager class instance
     */
    public static function paginatePosts(int $items_per_pages): Pager
    {
        $page = empty(Request::getQuery('page')) ? 1 : Request::getQuery('page');

        $total_items = Query::DB()
            ->select('*')
            ->from(static::$table)
            ->count();

        $pagination = generate_pagination($page, $total_items, $items_per_pages);

        $items = Query::DB()
            ->select(
                'posts.*',
                'users.name AS author_name'
            )
            ->from(static::$table)
            ->innerJoin('users', 'posts.user_id', 'users.id')
            ->orderBy('posts.title', 'DESC')
            ->fetchAll();

        return new Pager($items, $pagination);
    }
}