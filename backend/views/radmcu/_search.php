<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RadmcuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="radmcu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idrad') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'usia') ?>

    <?= $form->field($model, 'rmmcu') ?>

    <?php // echo $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'dokter') ?>

    <?php // echo $form->field($model, 'kesan') ?>

    <?php // echo $form->field($model, 'klinis') ?>

    <?php // echo $form->field($model, 'hasil') ?>

    <?php // echo $form->field($model, 'nofoto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
