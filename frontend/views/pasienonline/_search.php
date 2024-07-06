<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PasienonlineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasienonline-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nokartu') ?>

    <?= $form->field($model, 'idbayar') ?>

    <?= $form->field($model, 'noregistrasi') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'idpoli') ?>

    <?php // echo $form->field($model, 'nama_pasien') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'nohp') ?>

    <?php // echo $form->field($model, 'tgl_lahir') ?>

    <?php // echo $form->field($model, 'usia') ?>

    <?php // echo $form->field($model, 'idprov') ?>

    <?php // echo $form->field($model, 'idkab') ?>

    <?php // echo $form->field($model, 'idkec') ?>

    <?php // echo $form->field($model, 'idkel') ?>

    <?php // echo $form->field($model, 'pendidikan') ?>

    <?php // echo $form->field($model, 'no_ktp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
