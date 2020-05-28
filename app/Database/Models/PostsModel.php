<?php

namespace App\Database\Models;

use Framework\ORM\Model;

/**
 * PostsModel
 * 
 * Posts model class
 */
class PostsModel extends Model
{    
    /**
     * name of table
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * instantiates class
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct($this->table);
    }

    /**
     * get post row by slug
     *
     * @param  string $slug post slug
     * @return void
     */
    public function get(string $slug)
    {
        return $this->findSingle('slug', '=', $slug);
    }
}