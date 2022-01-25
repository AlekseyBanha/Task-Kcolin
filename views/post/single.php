<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $post->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= $post->description ?>
    </p>
    <small class="text-muted"><?= $post->created_at ?></small>

</div>
