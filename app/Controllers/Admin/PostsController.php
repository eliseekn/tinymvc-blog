<?php

namespace App\Controllers\Admin;

use Framework\HTTP\Request;
use Framework\Routing\View;
use App\Validators\PostForm;
use Framework\HTTP\Redirect;
use Framework\Support\Storage;
use App\Database\Models\PostsModel;

class PostsController
{
	/**
	 * display add post page
	 * 
	 * @return void
	 */
	public function add(): void
	{
		View::render('admin/posts/add');
	}
	
	/**
	 * display edit post page
	 * 
	 * @param  int $id
	 * @return void
	 */
	public function edit(int $id): void
	{
		if (!PostsModel::exists('id', $id)) {
			Redirect::back()->withError('Failed to get post infos. This post does not exists in database.');
		}

		View::render('admin/posts/edit', [
			'post' => PostsModel::find($id)
		]);
	}

	/**
	 * create new post
	 *
	 * @return void
	 */
	public function create(): void
	{
		PostForm::validate([
			'redirect' => 'back'
		]);

		if (PostsModel::exists('slug', slugify(Request::getField('title')))) {
			Redirect::back()->withError('Failed to create post. This post already exists in database.');
		}

		$image = Request::getFile('image', ['jpg', 'jpeg', 'png', 'bmp']);

		if (!$image->isUploaded()) {
			Redirect::back()->withError('Failed to upload post image to storage.');
		}
		
		if (!$image->isAllowed()) {
			Redirect::back()->withError('Invalid image format. Format authorized: ' . implode(', ', $image->allowed_extensions));
		}

		if (!Storage::isDir('uploads/posts/images')) {
			if (!Storage::createDir('uploads/posts/images', true)) {
				Redirect::back()->withError('Failed to create posts images storage.');
			}
		}

		if (!$image->moveTo('uploads/posts/images')) {
			Redirect::back()->withError('Failed to move post image to storage.');
		}

	    PostsModel::insert([
            'title' => Request::getField('title'),
			'slug' => slugify(Request::getField('title')),
			'user_id' => get_session('user')->id,
			'content' => Request::getField('content'),
			'image' => $image->filepath
        ]);

        Redirect::back()->withSuccess('The post has been created successfully.');
    }
    
	/**
	 * update post
	 *
     * @param  int $id
	 * @return void
	 */
	public function update(int $id): void
	{
		PostForm::validate([
			'redirect' => 'back'
		]);

		if (!PostsModel::exists('id', $id)) {
			Redirect::back()->withError('Failed to update post. This post does not exists in database.');
		}

		$data = [
            'title' => Request::getField('title'),
            'slug' => slugify(Request::getField('title')),
			'content' => Request::getField('content'),
            'updated_at' => date("Y-m-d H:i:s")
		];
		
		$image = Request::getFile('image', ['jpg', 'jpeg', 'png', 'bmp']);

		if ($image->isUploaded()) {
			if (!$image->isAllowed()) {
				Redirect::back()->withError('Invalid image file. Only allowed image in format ' . implode(', ', $image->allowed_extensions));
			}

			if (!Storage::isDir('uploads/posts/images')) {
				if (!Storage::createDir('uploads/posts/images', true)) {
					Redirect::back()->withError('Failed to create posts images storage.');
				}
			}

			if (!$image->moveTo('uploads/posts/images')) {
				Redirect::back()->withError('Failed to move post image to storage.');
			}

			if (!Storage::deleteFile(PostsModel::find($id)->image)) {
				Redirect::back()->withError('Failed to delete old post image from storage');
			}
			
			$data['image'] = $image->filepath;
		}

		PostsModel::update($id, $data);
        Redirect::back()->withSuccess('The post has been updated successfully.');
    }

	/**
	 * delete post
	 *
     * @param  int|null $id
	 * @return void
	 */
	public function delete(?int $id = null): void
	{
		if (!is_null($id)) {
			if (!PostsModel::exists('id', $id)) {
				Redirect::back()->withError('Failed to delete post. This post does not exists in database.');
			}
	
			Storage::deleteFile(PostsModel::find($id)->image);
			PostsModel::delete($id);
			Redirect::back()->withSuccess('The post has been deleted successfully.');
		} else {
			$posts_id = json_decode(Request::getRawData(), true);
			$posts_id = $posts_id['items'];

			foreach ($posts_id as $id) {
				Storage::deleteFile(PostsModel::find($id)->image);
				PostsModel::delete($id);
			}
			
			create_flash_message('success', 'The post has been deleted successfully.');
		}
    }
}
