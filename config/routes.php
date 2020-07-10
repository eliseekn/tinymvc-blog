<?php

/**
 * TinyMVC
 * 
 * PHP framework based on MVC architecture
 * 
 * @copyright 2019-2020 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/TinyMVC
 */

use Framework\Routing\View;
use Framework\Routing\Route;

/**
 * Set routes paths
 */

//home route
Route::group([
    '/' => [],
    '/home' => []
])->by([
    'method' => 'GET',
    'handler' => 'HomeController@index'
]);

//post routes
Route::get('/post/{slug:str}', [
    'handler' => 'PostController@index'
]);

//comments routes
Route::post('/comment/add/{post_id:num}', [
    'handler' => 'CommentController@add'
]);

//authentication routes
Route::get('/login', [
    'handler' => function() {
        View::render('auth/login');
    },
    'middlewares' => [
        'remember',
        'auth'
    ]
]);

Route::get('/signup', [
    'handler' =>  function() {
        View::render('auth/signup');
    },
    'middlewares' => [
        'remember',
        'auth'
    ]
]);

Route::get('/logout', [
    'handler' => 'AuthenticationController@logout'
]);

Route::post('/authenticate', [
    'handler' => 'AuthenticationController@authenticate'
]);

Route::post('/register', [
    'handler' => 'AuthenticationController@register'
]);

//admin routes
Route::get('/admin', [
    'handler' => 'Admin\AdminController@index',
    'middlewares' => [
        'remember',
        'admin'
    ]
]);

///users routes
Route::get('/admin/users/add', [
    'handler' => 'Admin\UsersController@add',
    'middlewares' => [
        'admin'
    ]
]);

Route::get('/admin/users', [
    'handler' => 'Admin\AdminController@users',
    'middlewares' => [
        'admin'
    ]
]);

Route::get('/admin/users/edit/{id:num}', [
    'handler' => 'Admin\UsersController@edit',
    'middlewares' => [
        'admin'
    ]
]);

Route::post('/admin/users/create', [
    'handler' => 'Admin\UsersController@create',
    'middlewares' => [
        'csrf',
        'sanitize',
        'admin'
    ]
]);

Route::post('/admin/users/update/{id:num}', [
    'handler' => 'Admin\UsersController@update',
    'middlewares' => [
        'csrf',
        'sanitize',
        'admin'
    ]
]);

Route::get('/admin/users/delete/{id:num}?', [
    'handler' => 'Admin\UsersController@delete',
    'middlewares' => [
        'admin'
    ]
]);

Route::post('/admin/users/delete/', [
    'handler' => 'Admin\UsersController@delete',
    'middlewares' => [
        'admin'
    ]
]);

///posts routes
Route::get('/admin/posts/add', [
    'handler' => 'Admin\PostsController@add',
    'middlewares' => [
        'admin'
    ]
]);

Route::get('/admin/posts', [
    'handler' => 'Admin\AdminController@posts',
    'middlewares' => [
        'admin'
    ]
]);

Route::get('/admin/posts/edit/{id:num}', [
    'handler' => 'Admin\PostsController@edit',
    'middlewares' => [
        'admin'
    ]
]);

Route::post('/admin/posts/create', [
    'handler' => 'Admin\PostsController@create',
    'middlewares' => [
        'csrf',
        'sanitize',
        'admin'
    ]
]);

Route::post('/admin/posts/update/{id:num}', [
    'handler' => 'Admin\PostsController@update',
    'middlewares' => [
        'csrf',
        'sanitize',
        'admin'
    ]
]);

Route::get('/admin/posts/delete/{id:num}?', [
    'handler' => 'Admin\PostsController@delete',
    'middlewares' => [
        'admin'
    ]
]);

Route::post('/admin/posts/delete/', [
    'handler' => 'Admin\PostsController@delete',
    'middlewares' => [
        'admin'
    ]
]);

///comments routes
Route::get('/admin/comments', [
    'handler' => 'Admin\AdminController@comments',
    'middlewares' => [
        'admin'
    ]
]);

Route::get('/admin/comments/edit/{id:num}', [
    'handler' => 'Admin\CommentsController@edit',
    'middlewares' => [
        'admin'
    ]
]);

Route::post('/admin/comments/update/{id:num}', [
    'handler' => 'Admin\CommentsController@update',
    'middlewares' => [
        'csrf',
        'sanitize',
        'admin'
    ]
]);

Route::get('/admin/comments/delete/{id:num}?', [
    'handler' => 'Admin\CommentsController@delete',
    'middlewares' => [
        'admin'
    ]
]);

Route::post('/admin/comments/delete/', [
    'handler' => 'Admin\CommentsController@delete',
    'middlewares' => [
        'admin'
    ]
]);

//password forgot routes
Route::get('/password/forgot', [
    'handler' => function() {
        View::render('password/reset');
    }
]);

Route::get('/password/reset', [
    'handler' => 'PasswordResetController@reset'
]);

Route::get('/password/notify', [
    'handler' => 'PasswordResetController@notify'
]);

Route::post('/password/new', [
    'handler' => 'PasswordResetController@new'
]);
