<?php $this->layout('layout', [
    'page_title' => 'The Mount Everest Blog | ' . $post->title,
    'page_description' => 'Blog about mountaineering',
    'header_title' => 'The Mount Everest Blog',
    'footer_title' => 'The Mount Everest Blog'
]) ?>

<?php $this->start('page_content') ?>

<section class="container my-5 mx-auto" style="max-width:950px">
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

    <article class="card mb-5">
        <img src="<?= absolute_url('/public/' . $post->image) ?>" class="card-img-top" alt="Featured image">

        <div class="card-body">
            <h2 class="card-title post-title"><?= $post->title ?></h2>
            <p class="card-text mt-3 text-justify"><?= $post->content ?></p>
            <a href="<?= absolute_url('/') ?>" class="btn btn-lg btn-dark">Go back home</a>
        </div>
    </article>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active lead" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Comments (<?= count($comments) ?>)</a>
            <a class="nav-item nav-link lead" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Leave a comment</a>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="mt-4">

                <?php foreach ($comments as $comment) : ?>

                    <p class="font-weight-bold"><?= $comment->email ?></p>
                    <p><?= $comment->comment ?></p>

                <?php endforeach ?>

            </div>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="mt-4">
                <form method="post" action="<?= absolute_url('/comment/add/' . $post->id) ?>">
                    <div class="form-group">
                        <label for="email">Your email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="comment">Your comment</label>
                        <textarea name="comment" id="comment" rows="5" class="form-control"></textarea>
                    </div>

                    <input type="submit" class="btn btn-lg btn-dark" value="Submit">
                </form>
            </div>
        </div>
    </div>
</section>

<?php $this->stop() ?>