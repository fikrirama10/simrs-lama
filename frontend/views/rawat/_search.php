<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RawatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rawat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idpengirim') ?>

    <?= $form->field($model, 'waktudikirim') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'rm') ?>

    <?php // echo $form->field($model, 'idp') ?>

    <?php // echo $form->field($model, 'ket') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
