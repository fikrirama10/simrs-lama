<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PermintaanBarangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permintaan-barang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idpermintaan') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'total') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'jenis') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
