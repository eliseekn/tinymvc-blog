<?php

namespace App\Controllers;

use Framework\Routing\View;
use App\Database\Models\PostsModel;
use App\Database\Models\CommentsModel;

class PostController
{
	/**
	 * display single post page
	 *
	 * @return void
	 */
	public function index(string $slug): void
	{
		$post = PostsModel::findWhere('slug', $slug);

		View::render('post', [
			'post' => $post,
			'comments' => CommentsModel::findAllWhere('post_id', $post->id)
		]);
	}
}
