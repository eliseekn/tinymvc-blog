<?php $this->layout('admin/layout', [
    'page_title' => 'Edit comment | Administration',
    'page_description' => 'Edit comment page'
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
    <div class="card-header bg-dark">
        <h3 class="mb-0 text-white">Edit comment</h3>
    </div>

    <form method="post" action="<?= absolute_url('/admin/comments/update/' . $comment->id) ?>">
        
        <?= generate_csrf_token() ?>

        <div class="card-body">
            <div class="form-group row">
                <label for="comment" class="col-sm-2 col-form-label">Comment</label>
                <div class="col-sm-10">
                    <textarea name="comment" id="comment" class="form-control" rows="5"><?= $comment->comment ?></textarea>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Update comment</button>
            <a href="<?= absolute_url('/admin/comments') ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php $this->stop() ?>
