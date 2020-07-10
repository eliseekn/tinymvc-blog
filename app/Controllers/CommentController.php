<?php

namespace App\Controllers;

use Framework\HTTP\Request;
use Framework\HTTP\Redirect;
use App\Validators\CommentForm;
use App\Database\Models\CommentsModel;

class CommentController
{
	/**
	 * add comment to post
	 *
	 * @param  int $post_id
	 * @return void
	 */
	public function add(int $post_id): void
	{
		CommentForm::validate([
			'redirect' => 'back'
		]);

		CommentsModel::insert([
			'email' => Request::getField('email'),
			'comment' => Request::getField('comment'),
			'post_id' => $post_id
		]);

		Redirect::back()->withSuccess('Your comment has been added successfully.');
	}
}
