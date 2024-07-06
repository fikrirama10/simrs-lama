<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OprasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oprasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'idoprasi') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'jenisoprasi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
