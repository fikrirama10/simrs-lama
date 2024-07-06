<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanRajalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemeriksaan-rajal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'idpoli') ?>

    <?= $form->field($model, 'iddokter') ?>

    <?= $form->field($model, 'suhu') ?>

    <?php // echo $form->field($model, 'respirasi') ?>

    <?php // echo $form->field($model, 'nadi') ?>

    <?php // echo $form->field($model, 'td') ?>

    <?php // echo $form->field($model, 'diagnosa') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'tindakan') ?>

    <?php // echo $form->field($model, 'obat') ?>

    <?php // echo $form->field($model, 'lab') ?>

    <?php // echo $form->field($model, 'radiologi') ?>

    <?php // echo $form->field($model, 'pemeriksaan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
