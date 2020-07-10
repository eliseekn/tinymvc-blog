<?php

namespace App\Controllers\Admin;

use Framework\Routing\View;
use App\Database\Models\PostsModel;
use App\Database\Models\UsersModel;
use App\Database\Models\CommentsModel;

class AdminController
{
	/**
	 * display admin dashboard page
	 *
	 * @return void
	 */
	public function index(): void
	{
		View::render('admin/index', [
			'users' => UsersModel::findAll(),
			'online_users' => UsersModel::findAllWhere('online', 1),
			'posts' => PostsModel::findPosts(),
			'comments' => CommentsModel::findComments()
		]);
	}

	/**
	 * display users page
	 *
	 * @return void
	 */
	public function users(): void
	{
		View::render('admin/users/index', [
			'users' => UsersModel::paginate(50, ['name', 'ASC'])
		]);
	}

	/**
	 * display posts page
	 *
	 * @return void
	 */
	public function posts(): void
	{
		View::render('admin/posts/index', [
			'posts' => PostsModel::paginatePosts(50)
		]);
	}

	/**
	 * display comments page
	 *
	 * @return void
	 */
	public function comments(): void
	{
		View::render('admin/comments/index', [
			'comments' => CommentsModel::paginate(50)
		]);
	}
}
