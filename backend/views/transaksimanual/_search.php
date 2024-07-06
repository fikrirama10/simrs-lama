<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransaksimanualSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksimanual-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idtrx') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'alamat') ?>

    <?= $form->field($model, 'usia') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
