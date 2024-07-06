<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CpSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'diagnosa') ?>

    <?= $form->field($model, 'patuh') ?>

    <?php // echo $form->field($model, 'validator') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
