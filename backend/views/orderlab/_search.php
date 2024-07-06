<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrderlabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orderlab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kodelab') ?>

    <?= $form->field($model, 'idpengirim') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?php // echo $form->field($model, 'idtkp') ?>

    <?php // echo $form->field($model, 'idpemeriksa') ?>

    <?php // echo $form->field($model, 'tgl_order') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
