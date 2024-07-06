<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArticlesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Title') ?>

    <?= $form->field($model, 'SubTitle') ?>

    <?= $form->field($model, 'Intro') ?>

    <?= $form->field($model, 'Content') ?>

    <?php // echo $form->field($model, 'Created') ?>

    <?php // echo $form->field($model, 'UserId') ?>

    <?php // echo $form->field($model, 'IdCat') ?>

    <?php // echo $form->field($model, 'IdBlock') ?>

    <?php // echo $form->field($model, 'IdPub') ?>

    <?php // echo $form->field($model, 'IsStatic') ?>

    <?php // echo $form->field($model, 'IsFeatured') ?>

    <?php // echo $form->field($model, 'Picture') ?>

    <?php // echo $form->field($model, 'IsHeadLine') ?>

    <?php // echo $form->field($model, 'Tags') ?>

    <?php // echo $form->field($model, 'SEO') ?>

    <?php // echo $form->field($model, 'ReadCount') ?>

    <?php // echo $form->field($model, 'LastUpdate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
