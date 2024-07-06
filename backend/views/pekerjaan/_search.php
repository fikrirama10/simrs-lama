<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PekerjaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pekerjaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'jenis_pekerjaan') ?>

    <?= $form->field($model, 'tempatkerja') ?>

    <?= $form->field($model, 'alamat_kerja') ?>

    <?= $form->field($model, 'notlp') ?>

    <?php // echo $form->field($model, 'idpasien') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
