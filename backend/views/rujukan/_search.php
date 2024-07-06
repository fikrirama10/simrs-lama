<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RujukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rujukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'usia') ?>

    <?php // echo $form->field($model, 'jk') ?>

    <?php // echo $form->field($model, 'penjamin') ?>

    <?php // echo $form->field($model, 'diagnosa') ?>

    <?php // echo $form->field($model, 'kebutuhan') ?>

    <?php // echo $form->field($model, 'waktu') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
