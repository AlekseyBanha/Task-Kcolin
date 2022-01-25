<?php

/* @var $this yii\web\View */

use app\models\Posts;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Add Post';
$this->params['breadcrumbs'][] = 'Add Post';
?>
<div class="site-about">
    <h1>Add Post</h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
