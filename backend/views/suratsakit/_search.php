<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SuratsakitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suratsakit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nomor') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'usia') ?>

    <?= $form->field($model, 'perusahaan') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'sampai') ?>

    <?php // echo $form->field($model, 'dari') ?>

    <?php // echo $form->field($model, 'no_rekmed') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
