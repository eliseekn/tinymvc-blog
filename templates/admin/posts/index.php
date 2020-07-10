<?php $this->layout('admin/layout', [
    'page_title' => 'Posts | Administration',
    'page_description' => 'Posts administration page'
]) ?>

<?php $this->start('page_content') ?>

<?php
if (session_has('flash_messages')) :
    $flash_messages = get_flash_messages('flash_messages');

    if (isset($flash_messages['success'])) :
?>
    <div class="alert alert-success alert-dismissible show" role="alert">

        <?php foreach ($flash_messages as $flash_message) : echo $flash_message . '<br>'; endforeach; ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php else : ?>

    <div class="alert alert-danger alert-dismissible show" role="alert">

        <?php
        foreach ($flash_messages as $flash_message) :
            if (is_array($flash_message)) :
                foreach ($flash_message as $error_message) :
                    echo $error_message . '<br>';
                endforeach;
            else :
                echo $flash_message . '<br>';
            endif;
        endforeach
        ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php
    endif;
endif
?>

<div class="card">
    <div class="card-header bg-dark d-flex align-items-center justify-content-between">
        <h3 class="mb-0 text-white">Posts</h3>
        
        <a href="<?= absolute_url('/admin/posts/add') ?>" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add new post
        </a>
    </div>

    <div class="card-body">
        <div class="input-group mb-5">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <li class="fa fa-search"></li>
                </div>
            </div>

            <input type="search" class="form-control" id="filter" placeholder="Filter results">
        </div>

        <div class="d-flex align-items-center justify-content-end mb-3">
            <button class="btn btn-danger ml-3" id="bulk-delete" data-url="<?= absolute_url('/admin/posts/delete/') ?>">
                <i class="fa fa-trash"></i> Bulk delete
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="select-all">
                                <label class="custom-control-label" for="select-all"></label>
                            </div>
                        </th>

                        <th scope="col"><i class="fa fa-sort"></i> ID</th>
                        <th scope="col"><i class="fa fa-sort"></i> Image</th>
                        <th scope="col"><i class="fa fa-sort"></i> Title</th>
                        <th scope="col"><i class="fa fa-sort"></i> Content</th>
                        <th scope="col"><i class="fa fa-sort"></i> Author</th>
                        <th scope="col"><i class="fa fa-sort"></i> Created at</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($posts as $post) : ?>

                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="<?= $post->id ?>" data-id="<?= $post->id ?>">
                                <label class="custom-control-label" for="<?= $post->id ?>"></label>
                            </div>
                        </td>

                        <td><?= $post->id ?></td>
                        <td><img src="<?= absolute_url('/public/' . $post->image) ?>" alt="" class="img-fluid"></td>
                        <td><?= $post->title ?></td>
                        <td><?= truncate($post->content, 100) ?></td>
                        <td><?= $post->author_name ?></td>
                        <td><?= $post->created_at ?></td>

                        <td>
                            <a class="btn text-primary" href="<?= absolute_url('/admin/posts/edit/' . $post->id) ?>">
                                <i class="fa fa-edit"></i>
                            </a>

                            <button class="btn text-danger" onclick="confirmDelete(this, 'Are you sure you want to delete this post?', '<?= absolute_url('/admin/posts/delete/' . $post->id) ?>')">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <?php endforeach ?>
                
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer d-flex align-items-center justify-content-between">
        <p class="lead mb-0">
            Total result(s): <span class="font-weight-bold"><?= $posts->getTotalItems() ?></span>
        </p>

        <nav>
            <ul class="pagination justify-content-center mb-0">

                <?php if ($posts->hasLess()) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $posts->previousPageUrl() ?>">
                        Previous
                    </a>
                </li>

                <?php 
                endif;
                
                if ($posts->totalPages() > 1) :
                    for ($i = 1; $i <= $posts->totalPages(); $i++) :
                ?>

                <li class="page-item <?php if ($posts->currentPage() === $i) : echo 'active'; endif ?>">
                    <a class="page-link" href="<?= $posts->pageUrl($i) ?>"><?= $i ?></a>
                </li>

                <?php
                    endfor;
                endif;
                
                if ($posts->hasMore()) : 
                ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $posts->nextPageUrl() ?>">
                        Next
                    </a>
                </li>

                <?php endif ?>

            </ul>
        </nav>
    </div>
</div>

<?php $this->stop() ?>
