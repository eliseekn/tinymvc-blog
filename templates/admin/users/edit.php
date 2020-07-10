<?php $this->layout('admin/layout', [
    'page_title' => 'Edit user | Administration',
    'page_description' => 'Edit user page'
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
        <h3 class="mb-0 text-white">Edit user</h3>
    </div>

    <form method="post" action="<?= absolute_url('/admin/users/update/' . $user->id) ?>">
        
        <?= generate_csrf_token() ?>

        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="<?= $user->name ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Email address</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" value="<?= $user->email ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">New password</label>

                <div class="d-flex align-items-center col-sm-10">
                    <input type="password" id="password" name="password" class="form-control">

                    <span class="btn" id="password-toggler" title="Toggle display">
                        <i class="fa fa-eye-slash"></i>
                    </span>
                </div>
            </div>

            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Role</legend>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="role" id="admin" value="admin" <?php if ($user->role === 'admin') : echo 'checked'; endif ?>>
                            <label class="custom-control-label" for="admin">Admin</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="role" id="user" value="user" <?php if ($user->role === 'user') : echo 'checked'; endif ?>>
                            <label class="custom-control-label" for="user">User</label>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Update user</button>
            <a href="<?= absolute_url('/admin/users') ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php $this->stop() ?>
