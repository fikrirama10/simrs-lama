<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanawalRanapSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemeriksaanawal-ranap-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'anamnesa') ?>

    <?= $form->field($model, 'kesadaran') ?>

    <?= $form->field($model, 'fisik') ?>

    <?php // echo $form->field($model, 'suhu') ?>

    <?php // echo $form->field($model, 'td') ?>

    <?php // echo $form->field($model, 'dokterpengirim') ?>

    <?php // echo $form->field($model, 'respirasi') ?>

    <?php // echo $form->field($model, 'nadi') ?>

    <?php // echo $form->field($model, 'diagnosa_awal') ?>

    <?php // echo $form->field($model, 'diagnosa_akhir') ?>

    <?php // echo $form->field($model, 'jam_masuk') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
