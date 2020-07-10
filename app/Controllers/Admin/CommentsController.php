<?php

namespace App\Controllers\Admin;

use Framework\HTTP\Request;
use Framework\Routing\View;
use Framework\HTTP\Redirect;
use App\Validators\UpdateCommentForm;
use App\Database\Models\CommentsModel;

class CommentsController
{
	/**
	 * display edit comment page
	 * 
	 * @param  int $id
	 * @return void
	 */
	public function edit(int $id): void
	{
		if (!CommentsModel::exists('id', $id)) {
			Redirect::back()->withError('Failed to get comment infos. This comment does not exists in database.');
		}

		View::render('admin/comments/edit', [
			'comment' => CommentsModel::find($id)
		]);
	}

	/**
	 * update comment
	 *
     * @param  int $id
	 * @return void
	 */
	public function update(int $id): void
	{
		UpdateCommentForm::validate([
			'redirect' => 'back'
		]);

		if (!CommentsModel::exists('id', $id)) {
			Redirect::back()->withError('Failed to update comment. This comment does not exists in database.');
		}

		CommentsModel::update($id, [
			'comment' => Request::getField('comment')
		]);

        Redirect::back()->withSuccess('The comment has been updated successfully.');
    }

	/**
	 * delete comment
	 *
     * @param  int|null $id
	 * @return void
	 */
	public function delete(?int $id = null): void
	{
		if (!is_null($id)) {
			if (!CommentsModel::exists('id', $id)) {
				Redirect::back()->withError('Failed to delete comment. This comment does not exists in database.');
			}
	
			CommentsModel::delete($id);
			Redirect::back()->withSuccess('The comment has been deleted successfully.');
		} else {
			$comments_id = json_decode(Request::getRawData(), true);
			$comments_id = $comments_id['items'];

			foreach ($comments_id as $id) {
				CommentsModel::delete($id);
			}
			
			create_flash_message('success', 'The comments has been deleted successfully.');
		}
    }
}
