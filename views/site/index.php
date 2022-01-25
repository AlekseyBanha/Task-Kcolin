<?php

/* @var $this yii\web\View */

use yii\bootstrap4\LinkPager;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>
<body>
<main>
    <div class="album  ">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <? foreach ($posts as $post) : ?>
                    <div class="col mt-4">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                 preserveAspectRatio="xMidYMid slice">
                                <rect width="100%" height="100%" fill="#55595c"/>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= $post->title ?></text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text"><?= $post->getShortDescription($post->description) ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-sm btn-outline-secondary"
                                           href="<?= Url::to(['/site/single', 'id' => $post->id]) ?>">View</a>
                                    </div>
                                    <small class="text-muted"><?= $post->created_at ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
    <div class="mt-3 offset-5"> <? echo LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
    </div>
</main>
</body>


