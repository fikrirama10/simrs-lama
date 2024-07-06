<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GagalfotoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gagalfoto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'jumlah') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'gagal') ?>

    <?= $form->field($model, 'jenisfoto') ?>

    <?php // echo $form->field($model, 'validator') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
