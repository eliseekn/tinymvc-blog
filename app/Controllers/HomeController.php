<?php

namespace App\Controllers;

use Framework\Routing\View;
use App\Database\Models\PostsModel;

class HomeController
{
	/**
	 * display home page
	 *
	 * @return void
	 */
	public function index(): void
	{
		View::render('index', [
			'posts' => PostsModel::paginate(10)
		]);
	}
}
