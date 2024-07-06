<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CucipoliSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cucipoli-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'petugas') ?>

    <?= $form->field($model, 'idpoli') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'patuh') ?>

    <?php // echo $form->field($model, 'validator') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
