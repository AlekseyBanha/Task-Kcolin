<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model app\models\ContactForm */


use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Register';
$this->params['breadcrumbs'][] = 'Register';
?>

<h1>Register</h1>

<div class="row">
    <div class="col-lg-5">

        <?php $form = ActiveForm::begin(['class'=>'form-horizontal']); ?>

        <?= $form->field($model, 'name')->textInput(['autofocus'=>true])?>

        <?= $form->field($model, 'email')?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
