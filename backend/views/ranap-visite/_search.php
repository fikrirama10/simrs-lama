<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanRanapVisiteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemeriksaan-ranap-visite-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'iddokter') ?>

    <?= $form->field($model, 'pemeriksaan_dokter') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
