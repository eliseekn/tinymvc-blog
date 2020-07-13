<?php $this->layout('layout', [
    'page_title' => 'The Mount Everest Blog',
    'page_description' => 'Blog about mountaineering',
    'header_title' => 'The Mount Everest Blog',
    'footer_title' => 'The Mount Everest Blog'
]) ?>

<?php $this->start('page_content') ?>

<section class="container my-5">
    <div class="row row-cols-2">

    <?php foreach ($posts as $post) : ?>

        <article class="col mb-5">
            <div class="card">
                <img 
                    src="<?= absolute_url('/public/' . $post->image) ?>" 
                    class="card-img-top" 
                    alt="Featured image">
                
                <div class="card-body">
                    <h2 class="card-title post-title"><?= $post->title ?></h2>
                    <div class="card-text mt-3">
                        <?= truncate($post->content, 290); ?>
                    </div>
                    <a href="<?= absolute_url('/post/' . $post->slug) ?>" class="btn btn-lg btn-dark read-more">Read more</a>
                </div>
            </div>
        </article>

    <?php endforeach ?>

    </div>
</section>

<nav class="my-5">
    <ul class="pagination pagination-lg justify-content-center">

        <?php if ($posts->currentPage() > 1) : ?>
        
        <li class="page-item">
            <a class="page-link text-dark" href="<?= $posts->previousPageUrl() ?>">
                <i class="fas fa-angle-double-left"></i>
            </a>
        </li>

        <?php endif ?>

        <?php if ($posts->totalPages() > 1) : ?>
        
        <li class="page-item page-link text-dark">
            Page <?= $posts->currentPage() ?>/<?= $posts->totalPages() ?>
        </li>
        
        <?php endif ?>

        <?php if ($posts->currentPage() < $posts->totalPages()) : ?>

        <li class="page-item">
            <a class="page-link text-dark" href="<?= $posts->nextPageUrl() ?>">
                <i class="fas fa-angle-double-right"></i>
            </a>
        </li>

        <?php endif ?>

    </ul>
</nav>

<?php $this->stop() ?>