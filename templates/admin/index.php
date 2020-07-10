<?php $this->layout('admin/layout', [
    'page_title' => 'TinyMVC | Administration dashboard',
    'page_description' => 'TinyMVC administration dashboard'
]) ?>

<?php $this->start('page_content') ?>

<div class="card-columns">
    <div class="card">
        <div class="card-header bg-dark text-white lead">Users</div>

        <div class="card-body">
            <p class="card-text">Total: <span class="font-weight-bold"><?= count($users) ?></span></p>
            <p class="card-text">Online: <span class="font-weight-bold"><?= count($online_users) ?></span></p>
            <p class="card-text">Latest registered: <span class="font-weight-bold"><?= $users[0]->name ?></span></p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white lead">Posts</div>

        <div class="card-body">
            <p class="card-text">Total: <span class="font-weight-bold"><?= count($posts) ?></span></p>

            <?php if (count($posts) > 0) : ?> 

            <p class="card-text">
                Latest published: <span class="font-weight-bold"><?= $posts[0]->title ?></span> <br>
                By <span class="font-weight-bold font-italic"><?= $posts[0]->author_name ?></span>
                At <span class="font-weight-bold font-italic"><?= $posts[0]->created_at ?></span>
            </p>

            <?php endif ?>

        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white lead">Comments</div>

        <div class="card-body">
            <p class="card-text">Total: <span class="font-weight-bold"><?= count($comments) ?></span></p>

            <?php if (count($comments) > 0) : ?> 

            <p class="card-text">
                Latest published: <span class="font-weight-bold"><?= $comments[0]->comment ?></span> <br>
                By <span class="font-weight-bold font-italic"><?= $comments[0]->email ?></span>
                On <span class="font-weight-bold font-italic"><?= $comments[0]->post_title ?></span>
                At <span class="font-weight-bold font-italic"><?= $comments[0]->created_at ?></span>
            </p>
            
            <?php endif ?>
            
        </div>
    </div>
</div>

<?php $this->stop() ?>