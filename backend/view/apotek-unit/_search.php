<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ApotekUnitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apotek-unit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idtrx') ?>

    <?= $form->field($model, 'unit') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'iduser') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
