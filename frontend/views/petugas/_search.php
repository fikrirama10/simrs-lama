<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PetugasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="petugas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode_petugas') ?>

    <?= $form->field($model, 'nama_petugas') ?>

    <?= $form->field($model, 'nohp') ?>

    <?= $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'jk') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
